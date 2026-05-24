# Changesets

This project uses [Changesets](https://github.com/changesets/changesets) for versioning and changelog generation.

## How to use

1. Run `npm run changeset` to create a new changeset
2. Select the type of change (major/minor/patch)
3. Write a summary of the change
4. Commit the generated markdown file along with your changes
5. On merge to `main`, run `npm run changeset:version` to bump versions and generate `CHANGELOG.md`
