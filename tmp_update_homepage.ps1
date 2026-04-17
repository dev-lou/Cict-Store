$ErrorActionPreference = 'Stop'
$path = 'c:\xampp\htdocs\cictstore\resources\views\home\homepage.blade.php'
$content = Get-Content -Raw -Path $path

$heroOpener = @'
    <section style="padding: 5rem 1.5rem; background: var(--color-gray-50);">
'@

$newHero = @'
    <section class="hero-section hero-section--home">
        <div style="max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; border-radius: 2rem; padding: clamp(2rem, 4vw, 3.5rem); background: linear-gradient(135deg, #7f0000 0%, #5c0000 52%, #3f0000 100%); box-shadow: 0 28px 60px rgba(91, 0, 0, 0.28);">
            <div style="position: absolute; inset: -20% -10% auto auto; width: 420px; height: 420px; background: radial-gradient(circle, rgba(255, 215, 140, 0.16), rgba(255, 215, 140, 0) 68%); pointer-events: none;"></div>
            <div style="position: absolute; left: -120px; bottom: -140px; width: 320px; height: 320px; background: radial-gradient(circle, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0) 72%); pointer-events: none;"></div>
            <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.14) 1px, transparent 1px); background-size: 28px 28px; opacity: 0.18; mask-image: linear-gradient(180deg, rgba(0,0,0,0.9), transparent 85%); pointer-events: none;"></div>

            <div style="display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(280px, 0.88fr); gap: 2rem; align-items: center; position: relative; z-index: 1;">
                <div style="display: grid; gap: 1.25rem;">
                    <div style="display: inline-flex; align-items: center; gap: 0.55rem; width: fit-content; padding: 0.55rem 0.95rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); color: white; font-size: 0.76rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase;">
                        <span style="width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: #f4c15a; box-shadow: 0 0 0 4px rgba(244,193,90,0.18);"></span>
                        ISUFST Dingle Campus
                    </div>

                    <div style="display: grid; gap: 0.85rem;">
                        <h1 style="color: white; text-shadow: 0 4px 14px rgba(0, 0, 0, 0.14); font-size: clamp(3rem, 7vw, 6rem); line-height: 0.93; letter-spacing: -0.06em; margin: 0; max-width: 9ch;">
                            CICT Store.
                        </h1>
                        <p style="margin: 0; color: rgba(255,255,255,0.95); font-size: clamp(1.1rem, 2.6vw, 1.4rem); line-height: 1.6; max-width: 34rem; font-weight: 500;">
                            Official campus merchandise, printing, and student support with a cleaner storefront experience.
                        </p>
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 0.85rem;">
                        <a href="{{ route('shop.index') }}" class="btn btn-primary" style="gap: 0.55rem;">
                            <span>Shop Collection</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                                <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </a>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary" style="gap: 0.55rem;">
                            <span>View Services</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                                <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </a>
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 0.65rem;">
                        <span style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Merchandise</span>
                        <span style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Printing</span>
                        <span style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Student support</span>
                    </div>
                </div>

                <div style="display: grid; gap: 1rem;">
                    <div style="position: relative; overflow: hidden; border-radius: 1.75rem; padding: 1.35rem; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.16); backdrop-filter: blur(18px); color: white; box-shadow: 0 18px 32px rgba(0,0,0,0.16);">
                        <div style="display:flex; align-items:center; justify-content:space-between; gap: 1rem; margin-bottom: 1rem;">
                            <div>
                                <p style="margin: 0 0 0.35rem 0; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.14em; color: rgba(255,255,255,0.72);">Official campus store</p>
                                <h2 style="margin: 0; font-size: clamp(1.4rem, 3vw, 2rem); line-height: 1.02; letter-spacing: -0.04em; color: white;">Built for students.</h2>
                            </div>
                            <div style="width: 3.25rem; height: 3.25rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.16); display: flex; align-items: center; justify-content: center; color: #f4c15a; font-size: 1.2rem; font-weight: 800;">CICT</div>
                        </div>
                        <p style="margin: 0; color: rgba(255,255,255,0.9); line-height: 1.7;">
                            A cleaner path from browse to checkout, with campus merchandise and services organized to feel official, easy, and trustworthy.
                        </p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 0.9rem;">
                        <div style="padding: 1rem; border-radius: 1.15rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); color: white;">
                            <p style="margin: 0; font-size: 1.75rem; font-weight: 800; line-height: 1;">Fast</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.76rem; text-transform: uppercase; letter-spacing: 0.09em; color: rgba(255,255,255,0.72);">Turnaround</p>
                        </div>
                        <div style="padding: 1rem; border-radius: 1.15rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); color: white;">
                            <p style="margin: 0; font-size: 1.75rem; font-weight: 800; line-height: 1;">Official</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.76rem; text-transform: uppercase; letter-spacing: 0.09em; color: rgba(255,255,255,0.72);">Campus store</p>
                        </div>
                        <div style="padding: 1rem; border-radius: 1.15rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); color: white;">
                            <p style="margin: 0; font-size: 1.75rem; font-weight: 800; line-height: 1;">Easy</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.76rem; text-transform: uppercase; letter-spacing: 0.09em; color: rgba(255,255,255,0.72);">To use</p>
                        </div>
                    </div>

                    <div style="display:flex; gap:0.9rem; align-items:center; padding:1rem 1.1rem; border-radius:1.25rem; background: rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.16); color:white;">
                        <div style="width:2.7rem; height:2.7rem; border-radius: 9999px; background: rgba(244,193,90,0.18); display:flex; align-items:center; justify-content:center; color:#f4c15a; font-weight:800;">★</div>
                        <div>
                            <p style="margin: 0; font-size: 0.82rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.7);">Trusted campus support</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.95rem; line-height: 1.6; color: rgba(255,255,255,0.9);">Built to feel modern, official, and easy to trust.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
'@

$newTrustStrip = @'
    <section style="padding: 0 1.5rem 4rem; background: var(--color-white);">
        <div style="max-width: 1200px; margin: -1.25rem auto 0; padding: 0;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
                <div style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(139, 0, 0, 0.08); color: var(--color-maroon); display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">01</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Student-led support</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">Built for campus needs with quick support and clear ordering.</p>
                    </div>
                </div>
                <div style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(91, 156, 246, 0.12); color: #215bbf; display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">02</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Reliable turnaround</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">Designed to make print and pickup feel fast, simple, and dependable.</p>
                    </div>
                </div>
                <div style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(244, 193, 90, 0.16); color: #8b5a00; display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">03</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Official campus store</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">A more credible storefront feel with clear hierarchy and brand trust.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
'@

$content = [regex]::Replace($content, '(?s)<section class="hero-section hero-section--home">.*?</section>\r?\n\r?\n    <section style="padding: 5rem 1.5rem; background: var\(--color-gray-50\);">', $newHero + "`r`n`r`n" + $heroOpener, 1)
$content = [regex]::Replace($content, '(?s)\r?\n\r?\n    <section style="padding: 4rem 1.5rem; background: var\(--color-white\);">.*?</section>\r?\n\r?\n</x-app-layout>', "`r`n`r`n" + $newTrustStrip + "`r`n</x-app-layout>", 1)
Set-Content -Path $path -Value $content
$ErrorActionPreference = 'Stop'
$path = 'c:\xampp\htdocs\cictstore\resources\views\home\homepage.blade.php'
$content = Get-Content -Raw -Path $path

$newHero = @'
    <section class="hero-section hero-section--home">
        <div style="max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; border-radius: 2rem; padding: clamp(2rem, 4vw, 3.5rem); background: linear-gradient(135deg, #7f0000 0%, #5c0000 52%, #3f0000 100%); box-shadow: 0 28px 60px rgba(91, 0, 0, 0.28);">
            <div style="position: absolute; inset: -20% -10% auto auto; width: 420px; height: 420px; background: radial-gradient(circle, rgba(255, 215, 140, 0.16), rgba(255, 215, 140, 0) 68%); pointer-events: none;"></div>
            <div style="position: absolute; left: -120px; bottom: -140px; width: 320px; height: 320px; background: radial-gradient(circle, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0) 72%); pointer-events: none;"></div>
            <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.14) 1px, transparent 1px); background-size: 28px 28px; opacity: 0.18; mask-image: linear-gradient(180deg, rgba(0,0,0,0.9), transparent 85%); pointer-events: none;"></div>

            <div style="display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(280px, 0.88fr); gap: 2rem; align-items: center; position: relative; z-index: 1;">
                <div style="display: grid; gap: 1.25rem;">
                    <div style="display: inline-flex; align-items: center; gap: 0.55rem; width: fit-content; padding: 0.55rem 0.95rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); color: white; font-size: 0.76rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase;">
                        <span style="width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: #f4c15a; box-shadow: 0 0 0 4px rgba(244,193,90,0.18);"></span>
                        ISUFST Dingle Campus
                    </div>

                    <div style="display: grid; gap: 0.85rem;">
                        <h1 style="color: white; text-shadow: 0 4px 14px rgba(0, 0, 0, 0.14); font-size: clamp(3rem, 7vw, 6rem); line-height: 0.93; letter-spacing: -0.06em; margin: 0; max-width: 9ch;">
                            CICT Store.
                        </h1>
                        <p style="margin: 0; color: rgba(255,255,255,0.95); font-size: clamp(1.1rem, 2.6vw, 1.4rem); line-height: 1.6; max-width: 34rem; font-weight: 500;">
                            Official campus merchandise, printing, and student support with a cleaner storefront experience.
                        </p>
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 0.85rem;">
                        <a href="{{ route('shop.index') }}" class="btn btn-primary" style="gap: 0.55rem;">
                            <span>Shop Collection</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                                <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </a>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary" style="gap: 0.55rem;">
                            <span>View Services</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                                <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </a>
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 0.65rem;">
                        <span style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Merchandise</span>
                        <span style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Printing</span>
                        <span style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Student support</span>
                    </div>
                </div>

                <div style="display: grid; gap: 1rem;">
                    <div style="position: relative; overflow: hidden; border-radius: 1.75rem; padding: 1.35rem; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.16); backdrop-filter: blur(18px); color: white; box-shadow: 0 18px 32px rgba(0,0,0,0.16);">
                        <div style="display:flex; align-items:center; justify-content:space-between; gap: 1rem; margin-bottom: 1rem;">
                            <div>
                                <p style="margin: 0 0 0.35rem 0; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.14em; color: rgba(255,255,255,0.72);">Official campus store</p>
                                <h2 style="margin: 0; font-size: clamp(1.4rem, 3vw, 2rem); line-height: 1.02; letter-spacing: -0.04em; color: white;">Built for students.</h2>
                            </div>
                            <div style="width: 3.25rem; height: 3.25rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.16); display: flex; align-items: center; justify-content: center; color: #f4c15a; font-size: 1.2rem; font-weight: 800;">CICT</div>
                        </div>
                        <p style="margin: 0; color: rgba(255,255,255,0.9); line-height: 1.7;">
                            A cleaner path from browse to checkout, with campus merchandise and services organized to feel official, easy, and trustworthy.
                        </p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 0.9rem;">
                        <div style="padding: 1rem; border-radius: 1.15rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); color: white;">
                            <p style="margin: 0; font-size: 1.75rem; font-weight: 800; line-height: 1;">Fast</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.76rem; text-transform: uppercase; letter-spacing: 0.09em; color: rgba(255,255,255,0.72);">Turnaround</p>
                        </div>
                        <div style="padding: 1rem; border-radius: 1.15rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); color: white;">
                            <p style="margin: 0; font-size: 1.75rem; font-weight: 800; line-height: 1;">Official</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.76rem; text-transform: uppercase; letter-spacing: 0.09em; color: rgba(255,255,255,0.72);">Campus store</p>
                        </div>
                        <div style="padding: 1rem; border-radius: 1.15rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); color: white;">
                            <p style="margin: 0; font-size: 1.75rem; font-weight: 800; line-height: 1;">Easy</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.76rem; text-transform: uppercase; letter-spacing: 0.09em; color: rgba(255,255,255,0.72);">To use</p>
                        </div>
                    </div>

                    <div style="display:flex; gap:0.9rem; align-items:center; padding:1rem 1.1rem; border-radius:1.25rem; background: rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.16); color:white;">
                        <div style="width:2.7rem; height:2.7rem; border-radius: 9999px; background: rgba(244,193,90,0.18); display:flex; align-items:center; justify-content:center; color:#f4c15a; font-weight:800;">★</div>
                        <div>
                            <p style="margin: 0; font-size: 0.82rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.7);">Trusted campus support</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.95rem; line-height: 1.6; color: rgba(255,255,255,0.9);">Built to feel modern, official, and easy to trust.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
'@

$newTrustStrip = @'
    <section style="padding: 0 1.5rem 4rem; background: var(--color-white);">
        <div style="max-width: 1200px; margin: -1.25rem auto 0; padding: 0;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
                <div style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(139, 0, 0, 0.08); color: var(--color-maroon); display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">01</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Student-led support</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">Built for campus needs with quick support and clear ordering.</p>
                    </div>
                </div>
                <div style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(91, 156, 246, 0.12); color: #215bbf; display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">02</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Reliable turnaround</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">Designed to make print and pickup feel fast, simple, and dependable.</p>
                    </div>
                </div>
                <div style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(244, 193, 90, 0.16); color: #8b5a00; display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">03</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Official campus store</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">A more credible storefront feel with clear hierarchy and brand trust.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
'@

$content = [regex]::Replace($content, '(?s)<section class="hero-section hero-section--home">.*?</section>\r?\n\r?\n    <section style="padding: 5rem 1.5rem; background: var\(--color-gray-50\);">', $newHero + "`r`n`r`n" + $heroOpener, 1)
$content = [regex]::Replace($content, '(?s)\r?\n\r?\n    <section style="padding: 4rem 1.5rem; background: var\(--color-white\);">.*?</section>\r?\n\r?\n</x-app-layout>', "`r`n`r`n" + $newTrustStrip + "`r`n</x-app-layout>", 1)
Set-Content -Path $path -Value $content

