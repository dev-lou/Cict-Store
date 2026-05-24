# Dev Tooling Guide

This project uses a suite of modern developer tools to maintain code quality, enforce conventions, and automate workflows. Below is a quick reference for each tool.

---

## 1. Changesets — Changelog & Versioning

**What it does:** [Changesets](https://github.com/changesets/changesets) generates a `CHANGELOG.md` from markdown files created alongside your changes.

**Workflow:**
```bash
npm run changeset        # Create a new changeset (commit this file)
npm run changeset:version # Bump versions & generate CHANGELOG.md
```

---

## 2. Commitlint — Conventional Commits

**What it does:** [Commitlint](https://commitlint.js.org/) enforces the [Conventional Commits](https://www.conventionalcommits.org/) format for all commit messages.

**Accepted types:** `feat`, `fix`, `docs`, `style`, `refactor`, `perf`, `test`, `build`, `ci`, `chore`, `revert`

**Accepted scopes:** `admin`, `api`, `auth`, `checkout`, `chat`, `email`, `home`, `inventory`, `orders`, `products`, `profile`, `reviews`, `scripts`, `services`, `supabase`, `tooling`, `deps`

**Example:**
```
feat(checkout): add free shipping banner
fix(auth): handle expired tokens gracefully
chore(deps): bump laravel/framework to 11.5
```

---

## 3. ESLint — JavaScript Linting

**What it does:** [ESLint](https://eslint.org/) (flat config) statically analyzes JS code for errors and style issues.

**Run it:**
```bash
npm run lint:js          # Check for issues
npm run lint:js -- --fix # Auto-fix what's possible
```

---

## 4. Laravel Pint — PHP Linting

**What it does:** [Pint](https://github.com/laravel/pint) is Laravel's opinionated PHP code style fixer, built on PHP-CS-Fixer.

**Run it:**
```bash
npm run lint:php         # Check for issues
npm run lint:php:fix     # Auto-fix all issues
```

Or directly:
```bash
vendor/bin/pint --test   # Check only
vendor/bin/pint          # Auto-fix
```

---

## 5. Lint-Staged — Staged File Checks

**What it does:** Runs Pint and ESLint **only on staged files** before each commit (via Husky). No more fixing the entire codebase for one typo.

Configured in `lint-staged.config.js`:

| Extension | Tool         |
|-----------|-------------|
| `*.php`   | `vendor/bin/pint` |
| `*.js`    | `eslint --fix`   |

---

## 6. Husky — Git Hooks

**What it does:** [Husky](https://typicode.github.io/husky/) manages Git hooks automatically. Installed via `npm run prepare` (runs after `npm install`).

**Active hooks:**
- **`pre-commit`** → runs `lint-staged` to check/fix staged files
- **`commit-msg`** → runs `commitlint` to validate the commit message

---

## 7. Renovate — Automated Dependency Updates

**What it does:** [Renovate](https://docs.renovatebot.com/) automatically opens PRs to update dependencies. Configured in `renovate.json`.

All dependencies are grouped into a single PR per run. `rangeStrategy: bump` pins exact versions.

---

## Quick Reference

```bash
npm run lint:php            # PHP syntax check (Pint)
npm run lint:php:fix        # PHP auto-fix (Pint)
npm run lint:js             # JavaScript check (ESLint)
npm run lint:js:fix         # JavaScript auto-fix (ESLint)
npm run changeset           # Create changelog entry
npm run changeset:version   # Generate CHANGELOG.md
```
