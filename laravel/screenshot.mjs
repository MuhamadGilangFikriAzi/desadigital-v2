import { chromium } from 'playwright';
import path from 'path';
import fs from 'fs';

const TARGET_URL = process.argv[2] || 'http://localhost/';
const OUTPUT_DIR = '/var/www/html/screenshots';

if (!fs.existsSync(OUTPUT_DIR)) {
  fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

(async () => {
  console.log('Screenshot: ' + TARGET_URL);
  const browser = await chromium.launch({
    headless: true,
    channel: 'chromium',
    executablePath: '/root/.cache/ms-playwright/chromium-1217/chrome-linux64/chrome',
    args: ['--no-sandbox', '--disable-setuid-sandbox'],
  });

  const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });

  try {
    await page.goto(TARGET_URL, { waitUntil: 'networkidle', timeout: 30000 });
    console.log('Page loaded: ' + await page.title());
  } catch (e) {
    console.log('Warnings: ' + e.message);
  }

  const safeName = TARGET_URL.replace(/[^a-zA-Z0-9]/g, '_').slice(0, 50);
  const filePath = path.join(OUTPUT_DIR, safeName + '.png');
  await page.screenshot({ path: filePath, fullPage: true });
  console.log('Screenshot saved: ' + filePath);

  const html = await page.content();
  const htmlPath = path.join(OUTPUT_DIR, safeName + '.html');
  fs.writeFileSync(htmlPath, html);
  console.log('HTML saved: ' + htmlPath);

  await browser.close();
  console.log('Done!');
})();
