import fs from 'fs';
const src = 'public/build/.vite/manifest.json';
const dest = 'public/build/manifest.json';

try {
  if (fs.existsSync(src) && !fs.existsSync(dest)) {
    fs.copyFileSync(src, dest);
    console.log(`Copied ${src} -> ${dest}`);
  } else if (fs.existsSync(dest)) {
    console.log(`${dest} exists; nothing to do.`);
  } else {
    console.log('No Vite manifest found in nested location.');
  }
} catch (e) {
  console.error('Failed to copy Vite manifest:', e);
  process.exit(1);
}
