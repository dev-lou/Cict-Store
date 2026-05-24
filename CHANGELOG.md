# Changelog

## 1.0.0 (2026-05-21)

### Features

- **tooling:** Add dev tooling stack — Changesets, Commitlint, ESLint, Husky, Renovate, CI/CD workflows ([267b97d5](https://github.com/cictstore/cict-store/commit/267b97d5))
  - Add Changesets for automated changelog and versioning
  - Add Commitlint with project-specific scopes (11 types, 17 scopes)
  - Add ESLint flat config for JavaScript linting
  - Add lint-staged to run Pint and ESLint on staged files
  - Add Renovate for automated dependency updates
  - Add Husky git hooks (pre-commit, commit-msg)
  - Add 5 CI/CD workflows: CI, Gitleaks, Commitlint, Socket Security, PR Agent
  - Add CODEOWNERS and commitlint-pr-title.json for repository governance
  - Add TOOLING.md with comprehensive dev onboarding documentation
  - Update package.json with 6 new scripts (+ prepare, lint:php, lint:js, changeset)
  - Update composer.json: fix route-params path, remove legacy hooks installer

### Chores

- **repo:** Clean up orphaned files, polish codebase ([2bf4b693](https://github.com/cictstore/cict-store/commit/2bf4b693))
  - Remove 9 orphaned controllers and 1 debug console command
  - Delete temp/backup files (tmp_update_homepage.ps1, PROJECT_DOCUMENTATION.md, .backup files)
  - Move CLOUDFLARE_MOBILE_OPTIMIZATION.md and SEO_GUIDE.md to docs/
  - Remove debug console.log statements from admin inventory edit view
  - Clean routes: remove GeminiDiag and /debug-db temp endpoint
  - Update .gitignore: deduplicate, ignore .env.testing

- **scripts:** Reorganize into deploy, diagnostics, and examples subdirectories ([46a8bcf0](https://github.com/cictstore/cict-store/commit/46a8bcf0), [02c91651](https://github.com/cictstore/cict-store/commit/02c91651))
  - Move deploy-optimize.php → scripts/deploy/
  - Move 10 diagnostic scripts → scripts/diagnostics/
  - Move 7 example scripts → scripts/examples/
  - Fix __DIR__ relative paths in all 15 moved scripts
  - Update .gitignore patterns for subdirectory coverage

### Fixes

- **style:** Fix 105 PHP code style violations across 157 files (Laravel Pint)
