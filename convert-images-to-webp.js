#!/usr/bin/env node

/**
 * Convert PNG images to WebP format for better performance
 * Usage: node convert-images-to-webp.js
 */

import fs from 'fs';
import path from 'path';
import { execSync } from 'child_process';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Image directories to process
const imageDirs = [
    'public/assets/gambar_landingpage',
    'public/assets/gambar_berita',
    'public/assets/logo-perusahaan',
    'public/admin/images/logos'
];

// Quality settings (0-100, higher = better quality but larger file)
const QUALITY = 80;

console.log('🖼️  Starting image conversion to WebP format...\n');

let totalOriginalSize = 0;
let totalWebPSize = 0;
let convertedCount = 0;
let skippedCount = 0;

imageDirs.forEach(dir => {
    const fullPath = path.join(__dirname, dir);
    
    if (!fs.existsSync(fullPath)) {
        console.log(`⚠️  Directory not found: ${dir}`);
        return;
    }
    
    console.log(`📁 Processing: ${dir}`);
    
    const files = fs.readdirSync(fullPath);
    const pngFiles = files.filter(f => f.toLowerCase().endsWith('.png'));
    
    if (pngFiles.length === 0) {
        console.log(`   No PNG files found\n`);
        return;
    }
    
    pngFiles.forEach(file => {
        const inputPath = path.join(fullPath, file);
        const outputPath = path.join(fullPath, file.replace(/\.png$/i, '.webp'));
        
        try {
            // Get original file size
            const originalStats = fs.statSync(inputPath);
            const originalSize = originalStats.size;
            
            // Skip if WebP already exists
            if (fs.existsSync(outputPath)) {
                const webpStats = fs.statSync(outputPath);
                console.log(`   ⏭️  ${file} (WebP already exists: ${(webpStats.size / 1024).toFixed(2)} KB)`);
                skippedCount++;
                return;
            }
            
            // Convert to WebP
            console.log(`   ⏳ Converting: ${file}...`);
            execSync(`npx cwebp -q ${QUALITY} "${inputPath}" -o "${outputPath}"`, {
                stdio: 'pipe'
            });
            
            // Get WebP file size
            const webpStats = fs.statSync(outputPath);
            const webpSize = webpStats.size;
            const savings = originalSize - webpSize;
            const savingsPercent = ((savings / originalSize) * 100).toFixed(1);
            
            totalOriginalSize += originalSize;
            totalWebPSize += webpSize;
            convertedCount++;
            
            console.log(`   ✅ ${file}`);
            console.log(`      Original: ${(originalSize / 1024).toFixed(2)} KB → WebP: ${(webpSize / 1024).toFixed(2)} KB (Saved: ${(savings / 1024).toFixed(2)} KB, ${savingsPercent}%)`);
            
        } catch (error) {
            console.log(`   ❌ Error converting ${file}:`, error.message);
        }
    });
    
    console.log('');
});

// Summary
console.log('\n📊 Conversion Summary:');
console.log(`   ✅ Converted: ${convertedCount} files`);
console.log(`   ⏭️  Skipped: ${skippedCount} files`);
console.log(`   📦 Total Original Size: ${(totalOriginalSize / 1024).toFixed(2)} KB`);
console.log(`   📦 Total WebP Size: ${(totalWebPSize / 1024).toFixed(2)} KB`);
console.log(`   💾 Total Savings: ${((totalOriginalSize - totalWebPSize) / 1024).toFixed(2)} KB (${(((totalOriginalSize - totalWebPSize) / totalOriginalSize) * 100).toFixed(1)}%)`);

console.log('\n✨ Next steps:');
console.log('   1. Update your HTML to use <picture> tags for WebP support');
console.log('   2. Example:');
console.log('      <picture>');
console.log('        <source srcset="image.webp" type="image/webp">');
console.log('        <img src="image.png" alt="Description">');
console.log('      </picture>');
console.log('   3. Or use img-src attribute: <img src="image.webp" alt="Description">');
console.log('   4. Modern browsers support WebP; older browsers will fallback to PNG');
console.log('');
