<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/main.js"></script>
    <link rel="icon" href="/assets/icon.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Depth Portfolio</title>
    <style>
        body {
            background-image: url('/assets/3d_bg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            backdrop-filter: blur(10px);
        }
        .content-wrapper {
            min-height: 100vh;
        }
        summary {
            cursor: pointer;
        }
        summary::marker {
            display: none;
        }
        .file-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .file-item {
            cursor: pointer;
            text-align: center;
            width: 120px;
            padding: 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
        }
        .file-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .file-item i {
            font-size: 3rem;
        }
        .file-item-name {
            margin-top: 0.5rem;
            word-wrap: break-word;
            font-size: 0.9rem;
        }
        .folder-summary {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .folder-summary i {
            font-size: 1.2rem;
        }
        details[open] > summary .bi-caret-right-fill::before {
            transform: rotate(90deg);
        }
        .bi-caret-right-fill {
            transition: transform 0.2s;
        }
    </style>
</head>
<body>
    <!-- 내비게이션 바가 삽입될 위치 -->
    <div id="navbar-placeholder"></div>

    <div class="content-wrapper">
        <!-- 포트폴리오 -->
        <div class="container py-5 text-white" style="padding-top: 8rem !important;">
            <div class="mb-3">
                <a href="/" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left-circle"></i> 뒤로가기
                </a>
            </div>
            <h1 class="text-primary fw-bold mb-4">Portfolio</h1>
            <h2 id="main-title" class="mb-4 fw-semibold text-white"></h2>
            <div id="file-list-container">
                <!-- PHP와 JS로 파일 목록이 들어감 -->
            </div>
        </div>
    </div>

    <?php
        $excluded_items = ['index.php', '..', '.'];
        function get_directory_tree($dir = '.') {
            $items = [];
            if (!is_dir($dir)) return [];
            $files = scandir($dir);
            foreach ($files as $file) {
                if (in_array($file, $GLOBALS['excluded_items'])) continue;
                $path = $dir === '.' ? $file : $dir . '/' . $file;
                $item_data = ['name' => $file, 'path' => $path];
                if (is_dir($path)) {
                    $item_data['type'] = 'dir';
                    $item_data['children'] = get_directory_tree($path);
                } else {
                    $item_data['type'] = 'file';
                }
                $items[] = $item_data;
            }
            return $items;
        }
        $items_tree = get_directory_tree('.');
    ?>

    <script>
        const pathParts = window.location.pathname.split('/').filter(Boolean);
        const folderName = pathParts.length > 1 ? decodeURIComponent(pathParts[pathParts.length - 1] || '') : 'Portfolio';
        document.title = `Depth Portfolio | ${folderName}`;
        document.getElementById('main-title').textContent = folderName;

        const items = <?php echo json_encode($items_tree); ?>;
        const container = document.getElementById('file-list-container');
        const previewableExtensions = ['html', 'css', 'js', 'php', 'txt', 'md', 'json', 'xml', 'py', 'java', 'c', 'cpp', 'cs', 'go', 'rb', 'rs', 'sql', 'swift', 'ts', 'sh', 'bat', 'svg', 'png', 'jpg', 'jpeg', 'gif', 'webp'];
        
        const fileIcons = {
            'dir': 'bi-folder-fill text-warning',
            'html': 'bi-filetype-html text-danger',
            'css': 'bi-filetype-css text-info',
            'js': 'bi-filetype-js text-warning',
            'php': 'bi-filetype-php text-primary',
            'py': 'bi-filetype-py text-success',
            'cpp': 'bi-filetype-cpp text-primary',
            'c': 'bi-filetype-c text-primary',
            'zip': 'bi-file-zip-fill text-secondary',
            'exe': 'bi-file-earmark-binary-fill text-secondary',
            'png': 'bi-file-image text-success',
            'jpg': 'bi-file-image text-success',
            'jpeg': 'bi-file-image text-success',
            'gif': 'bi-file-image text-success',
            'svg': 'bi-file-image text-success',
            'default': 'bi-file-earmark-text text-light'
        };

        function getFileIcon(fileName, type) {
            if (type === 'dir') return fileIcons['dir'];
            const extension = fileName.split('.').pop().toLowerCase();
            return fileIcons[extension] || fileIcons['default'];
        }

        function createPreviewAction(filePath) {
            const basePath = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/') + 1);
            const fullFilePath = basePath + filePath;
            window.open(`/preview.html?file=${encodeURIComponent(fullFilePath)}`, 'previewWindow', 'width=1000,height=800,scrollbars=yes,resizable=yes');
        }

        function forceDownload(url, fileName) {
            const a = document.createElement('a');
            a.href = url;
            a.download = fileName;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        function renderItems(element, items) {
            if (!items || items.length === 0) {
                if (element.id === 'file-list-container') {
                    element.innerHTML = '<div class="alert alert-secondary text-center">표시할 프로젝트가 없습니다.</div>';
                }
                return;
            }

            const grid = document.createElement('div');
            grid.className = 'file-grid';

            items.forEach(item => {
                if (item.type === 'dir') {
                    const details = document.createElement('details');
                    details.open = true;
                    details.className = 'w-100 mb-3';
                    
                    const summary = document.createElement('summary');
                    summary.className = 'folder-summary text-white mb-2';
                    summary.innerHTML = `<i class="bi bi-caret-right-fill"></i><i class="bi ${getFileIcon(item.name, 'dir')}"></i><span>${item.name}</span>`;
                    details.appendChild(summary);

                    const childrenContainer = document.createElement('div');
                    childrenContainer.className = 'ps-4';
                    details.appendChild(childrenContainer);
                    
                    if (item.children && item.children.length > 0) {
                        renderItems(childrenContainer, item.children);
                    } else {
                        childrenContainer.innerHTML = '<div class="text-muted">폴더가 비어있습니다.</div>';
                    }
                    element.appendChild(details);

                } else { // 파일 타입
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'file-item';
                    
                    const iconClass = getFileIcon(item.name, 'file');
                    itemDiv.innerHTML = `
                        <i class="bi ${iconClass}"></i>
                        <div class="file-item-name text-white">${item.name}</div>
                    `;

                    const extension = item.name.split('.').pop().toLowerCase();
                    if (previewableExtensions.includes(extension)) {
                        itemDiv.onclick = () => createPreviewAction(item.path);
                    } else {
                        itemDiv.onclick = () => forceDownload(item.path, item.name);
                    }
                    grid.appendChild(itemDiv);
                }
            });
            if (grid.hasChildNodes()) {
                element.appendChild(grid);
            }
        }

        renderItems(container, items);
    </script>
    
    <!-- 푸터가 삽입될 위치 -->
    <div id="footer-placeholder"></div>
</body>
</html>