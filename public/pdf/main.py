import asyncio
from pyppeteer import launch
import time

async def generate_pdf(url, pdf_path):
    browser = await launch()
    page = await browser.newPage()
    time.sleep(1)
    await page.goto(url)
    await page.pdf({'path': pdf_path, 'format': 'A4'})
    await browser.close()

# Run the function
asyncio.get_event_loop().run_until_complete(generate_pdf('http://localhost/endoindex/exportindex/1', 'D:\laragon\htdocs\store\summary_report.pdf'))