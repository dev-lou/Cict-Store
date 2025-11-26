# Render / Supabase — Troubleshooting & Fixes

Why your Render app cannot reach Supabase (common cause):
* Supabase project endpoint can sometimes be IPv6-only (AAAA DNS record only) and Render's service might use IPv4 for outgoing network traffic only. If that's the case, a connection attempt to the Supabase host will fail with `Network is unreachable` and your app will see `SQLSTATE[08006]` errors.

What I added to help diagnose & fix this:

* app changes:
  * The code now prefers `DB_HOST_IPV4` when present and attempts to resolve DNS A/AAAA records for `DB_HOST` at boot. It logs the DNS A/AAAA results to help you diagnose the network reachability problem.
  * If the database is unreachable, public GET pages (e.g., `/`, `/shop`) are allowed to pass through and controllers will attempt to use cache or the Supabase REST API fallback.
  * Product and homepage controllers now use cache and the Supabase REST API as fallbacks when Postgres is unreachable.
  * `healthz` returns info about whether DB is ok, and if a Supabase REST fallback is available.
  * `scripts/check_db_connectivity.php` - a script you can run in the Render web console that prints resolved A/AAAA records and tests TCP connectivity for each.

Quick steps you can run on Render console to check what is going on:

1) Run the DNS/connectivity checker (in your Render service console):

```sh
# From your repository root
php scripts/check_db_connectivity.php
```

This will show resolved IPv4 and IPv6 addresses and whether a TCP connection can be established to each.

2) If you see only IPv6 AAAA addresses and no IPv4 A records, it confirms your route: it is an IPv6-only host and the Render egress network is IPv4-only.

3) Quick fixes (pick one):

A) If Supabase can provide an IPv4 A record

* Update your Render environment variable `DB_HOST` with the provided IPv4 host or set `DB_HOST_IPV4` to the new IPv4 address. Then redeploy.

B) Use a small IPv4 proxy (temporary workaround)

* Provision a small VM that has a public IPv4 address (DigitalOcean droplet is easy).
* Install `socat` and forward `TCP port 5432` from the droplet to the Supabase IPv6 host:

```sh
sudo apt update && sudo apt install -y socat
sudo socat TCP-LISTEN:5432,reuseaddr,fork TCP6:db.ppsdvdrnvquykxsmwjmg.supabase.co:5432 &
```

* Update `DB_HOST` or `DB_HOST_IPV4` in Render to the IPv4 address of the droplet and redeploy.

Pros: Quick and works with IPv6-only DB.
Cons: You must secure the droplet and open port 5432 only to Render IPs.

C) Use Supabase REST API fallback (approximate read-only experience)

* Set `SUPABASE_SERVICE_ROLE_KEY` or `SUPABASE_ANON_KEY` in your Render environment variables.
* Redeploy. The app will attempt to use Supabase REST read-only API for public pages (home/shop/product) when DB connection is unavailable.
* This does not enable writes (e.g., product management, orders), but it keeps your storefront visible.

D) Migrate the DB to an IPv4-enabled host (long-term)

* Move to a DB provider that provides IPv4 A record endpoints.

4) After making any env changes and redeploy:

- Visit `/healthz` to confirm status. The JSON shows `db` and `fallback` status.
- Check Render logs and search `DegradedMode: DB unreachable`, `Supabase REST fallback` or `DB host DNS records` to find more details.

If you want me to provide an automated helper for the proxy setup (socat service + systemd unit + small script to restrict access to Render IPs), say “Yes — provide proxy scaffold” and I’ll generate the files and a README to provision them on a DO droplet.