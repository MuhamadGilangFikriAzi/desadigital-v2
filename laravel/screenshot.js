const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const TARGET_URL = process.argv[2] || 'http://localhost:8080';
const OUTPUT_DIR = '/app/screenshots';

if (!fs.existsSync(OUTPUT_DIR)) {
  fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

(async () => {
  console.log(`📸 Playwright screenshot: ${TARGET_URL}`);
  const browser = await chromium.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox'],
  });

  const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });

  try {
    await page.goto(TARGET_URL, { waitUntil: 'networkidle', timeout: 30000 });
    console.log(`✅ Page loaded: ${await page.title()}`);
  } catch (e) {
    console.log(`⚠️ Page loaded with warnings: ${e.message}`);
  }

  // Screenshot full page
  const safeName = TARGET_URL.replace(/[^a-zA-Z0-9]/g, '_').slice(0, 50);
  const filePath = path.join(OUTPUT_DIR, `${safeName}.png`);
  await page.screenshot({ path: filePath, fullPage: true });
  console.log(`✅ Screenshot saved: ${filePath}`);

  // Also grab HTML content
  const html = await page.content();
  const htmlPath = path.join(OUTPUT_DIR, `${safeName}.html`);
  fs.writeFileSync(htmlPath, html);
  console.log(`✅ HTML saved: ${htmlPath}`);

  await browser.close();
  console.log('🎉 Done!');
})();
