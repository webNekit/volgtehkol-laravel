import fs from 'fs';
import path from 'path';

// Название итогового файла
const outputFile = 'project_code_for_ai.md';

// Папки, которые КРИТИЧЕСКИ ВАЖНО пропустить
const excludeDirs = [
    'node_modules',
    'vendor',
    '.git',
    '.idea',
    'storage',
    'bootstrap/cache',
    'public/build'
];

// Расширения файлов, которые мы пропускаем
const excludeExtensions = [
    '.js',
    '.jpg', '.jpeg', '.png', '.gif', '.svg', '.ico', '.webp',
    '.woff', '.woff2', '.ttf', '.eot',
    '.sqlite', '.log',
    '.lock',
    '.phar'
];

function getLanguage(filename) {
    if (filename.endsWith('.blade.php')) return 'html';
    const ext = path.extname(filename);
    const map = {
        '.php': 'php', '.json': 'json', '.env': 'bash',
        '.yml': 'yaml', '.css': 'css', '.ts': 'typescript',
        '.xml': 'xml'
    };
    return map[ext] || '';
}

function getAllFiles(dirPath, arrayOfFiles) {
    const files = fs.readdirSync(dirPath);
    arrayOfFiles = arrayOfFiles || [];

    files.forEach(function(file) {
        const fullPath = path.join(dirPath, file);
        const stat = fs.statSync(fullPath);

        if (stat.isDirectory()) {
            if (!excludeDirs.includes(file)) {
                arrayOfFiles = getAllFiles(fullPath, arrayOfFiles);
            }
        } else {
            const ext = path.extname(file).toLowerCase();
            if (!excludeExtensions.includes(ext) && file !== outputFile && file !== 'export.js') {
                arrayOfFiles.push(fullPath);
            }
        }
    });

    return arrayOfFiles;
}

try {
    console.log('Начинаю сбор файлов...');
    const files = getAllFiles('./');
    let markdownContent = '# Исходный код проекта Laravel\n\n';

    files.forEach(file => {
        try {
            const content = fs.readFileSync(file, 'utf8');
            const lang = getLanguage(file);
            const relativePath = file.replace(/\\/g, '/');

            markdownContent += `### Файл: \`${relativePath}\`\n\n`;
            markdownContent += `\`\`\`${lang}\n`;
            markdownContent += content;
            markdownContent += `\n\`\`\`\n\n`;
        } catch (e) {
            console.log(`Пропущен файл (не читается как текст): ${file}`);
        }
    });

    fs.writeFileSync(outputFile, markdownContent);
    console.log(`✅ Готово! Все файлы собраны в: ${outputFile}`);
} catch (err) {
    console.error('❌ Ошибка при выполнении:', err);
}
