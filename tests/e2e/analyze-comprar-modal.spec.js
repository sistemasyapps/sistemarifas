import { test, expect } from '@playwright/test';

const baseUrl = (process.env.PLAYWRIGHT_BASE_URL || process.env.APP_URL || 'http://localhost:8000').replace(/\/+$/, '');

test.describe('Analyze Comprar Modal', () => {
  test('capture homepage and modal screenshots', async ({ page }) => {
    // Navigate to homepage
    await page.goto(`${baseUrl}/`);

    // Wait for page to load completely
    await page.waitForLoadState('networkidle');

    // Take screenshot of homepage
    await page.screenshot({
      path: '.playwright-mcp/home-current-state.png',
      fullPage: true
    });

    console.log('✓ Homepage screenshot captured');

    // Find and click the Comprar button
    // Try multiple selectors to find the button
    const comprarButton = await page.locator('button:has-text("Comprar")').first();

    // Wait for button to be visible
    await comprarButton.waitFor({ state: 'visible', timeout: 10000 });

    // Scroll to button if needed
    await comprarButton.scrollIntoViewIfNeeded();

    // Take screenshot before clicking
    await page.screenshot({
      path: '.playwright-mcp/before-click-comprar.png',
      fullPage: false
    });

    console.log('✓ Before click screenshot captured');

    // Click the Comprar button
    await comprarButton.click();

    // Wait for modal to appear
    await page.waitForTimeout(1000); // Give modal time to animate

    // Wait for modal to be visible
    const modal = await page.locator('.modal, [role="dialog"], .modal-content').first();
    await modal.waitFor({ state: 'visible', timeout: 5000 });

    console.log('✓ Modal opened');

    // Take full page screenshot with modal
    await page.screenshot({
      path: '.playwright-mcp/modal-opened-full.png',
      fullPage: true
    });

    // Take viewport screenshot focused on modal
    await page.screenshot({
      path: '.playwright-mcp/modal-opened-viewport.png',
      fullPage: false
    });

    console.log('✓ Modal screenshots captured');

    // Analyze modal structure
    const modalHTML = await modal.innerHTML();
    console.log('\n=== MODAL HTML STRUCTURE ===');
    console.log(modalHTML.substring(0, 2000)); // First 2000 chars

    // Find ticket number selection boxes
    const ticketBoxes = await page.locator('.modal input[type="number"], .modal select, .modal .cuadrito, .modal [class*="ticket"], .modal [class*="numero"]').all();
    console.log(`\n✓ Found ${ticketBoxes.length} potential ticket selection elements`);

    // Get all text content in modal
    const modalText = await modal.innerText();
    console.log('\n=== MODAL TEXT CONTENT ===');
    console.log(modalText);

    // Look for specific elements
    const buttons = await page.locator('.modal button').all();
    console.log(`\n✓ Found ${buttons.length} buttons in modal`);

    for (let i = 0; i < buttons.length; i++) {
      const btnText = await buttons[i].innerText();
      console.log(`  Button ${i + 1}: "${btnText}"`);
    }

    // Check for form inputs
    const inputs = await page.locator('.modal input').all();
    console.log(`\n✓ Found ${inputs.length} input fields in modal`);

    for (let i = 0; i < Math.min(inputs.length, 10); i++) {
      const inputType = await inputs[i].getAttribute('type');
      const inputName = await inputs[i].getAttribute('name');
      const inputPlaceholder = await inputs[i].getAttribute('placeholder');
      console.log(`  Input ${i + 1}: type="${inputType}", name="${inputName}", placeholder="${inputPlaceholder}"`);
    }
  });
});
