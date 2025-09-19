<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rich Text Editor Comparison</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    
    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <style>
        .editor-container {
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }
        
        .editor-header {
            background: #f8fafc;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        
        .editor-content {
            min-height: 300px;
        }
        
        .comparison-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        @media (max-width: 768px) {
            .comparison-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .feature-list {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }
        
        .feature-list ul {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            padding: 0.25rem 0;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .feature-list li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Rich Text Editor Comparison</h1>
                <p class="text-lg text-gray-600">Compare CKEditor vs TinyMCE side by side</p>
            </div>

            <!-- Comparison Grid -->
            <div class="comparison-grid">
                <!-- CKEditor Section -->
                <div class="editor-container">
                    <div class="editor-header">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">CKEditor 5</h2>
                        <p class="text-sm text-gray-600">Version 41.3.1 - Classic Editor</p>
                    </div>
                    <div class="p-4">
                        <div id="ckeditor" class="editor-content">
                            <h2>Welcome to CKEditor 5!</h2>
                            <p>This is a sample blog post to test the <strong>CKEditor 5</strong> functionality. Let's see how it handles various content types:</p>
                            
                            <h3>Key Features:</h3>
                            <ul>
                                <li>Modern, clean interface</li>
                                <li>Excellent text formatting options</li>
                                <li>Image upload and management</li>
                                <li>Table support</li>
                                <li>Link management</li>
                            </ul>
                            
                            <blockquote>
                                <p>"CKEditor 5 provides a great balance between features and performance for most web applications."</p>
                            </blockquote>
                            
                            <h3>Sample Table:</h3>
                            <table border="1" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="padding: 8px;">Feature</th>
                                        <th style="padding: 8px;">Rating</th>
                                        <th style="padding: 8px;">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 8px;">Ease of Use</td>
                                        <td style="padding: 8px;">⭐⭐⭐⭐⭐</td>
                                        <td style="padding: 8px;">Very intuitive</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px;">Performance</td>
                                        <td style="padding: 8px;">⭐⭐⭐⭐</td>
                                        <td style="padding: 8px;">Good speed</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <p>Try editing this content to see how CKEditor 5 performs!</p>
                        </div>
                    </div>
                </div>

                <!-- TinyMCE Section -->
                <div class="editor-container">
                    <div class="editor-header">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">TinyMCE 6</h2>
                        <p class="text-sm text-gray-600">Latest Version - Modern Editor</p>
                    </div>
                    <div class="p-4">
                        <div id="tinymce" class="editor-content">
                            <h2>Welcome to TinyMCE!</h2>
                            <p>This is a sample blog post to test the <strong>TinyMCE 6</strong> functionality. Let's see how it handles various content types:</p>
                            
                            <h3>Key Features:</h3>
                            <ul>
                                <li>Extremely fast and lightweight</li>
                                <li>Rich plugin ecosystem</li>
                                <li>Excellent mobile support</li>
                                <li>Advanced table editing</li>
                                <li>Powerful media management</li>
                            </ul>
                            
                            <blockquote>
                                <p>"TinyMCE offers the best balance of performance and features for modern web applications."</p>
                            </blockquote>
                            
                            <h3>Sample Table:</h3>
                            <table border="1" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="padding: 8px;">Feature</th>
                                        <th style="padding: 8px;">Rating</th>
                                        <th style="padding: 8px;">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 8px;">Ease of Use</td>
                                        <td style="padding: 8px;">⭐⭐⭐⭐⭐</td>
                                        <td style="padding: 8px;">Very intuitive</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px;">Performance</td>
                                        <td style="padding: 8px;">⭐⭐⭐⭐⭐</td>
                                        <td style="padding: 8px;">Excellent speed</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <p>Try editing this content to see how TinyMCE performs!</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature Comparison -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="feature-list">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">CKEditor 5 Features</h3>
                    <ul>
                        <li>Modern, clean interface</li>
                        <li>Excellent text formatting</li>
                        <li>Image upload & management</li>
                        <li>Table support</li>
                        <li>Link management</li>
                        <li>Block quotes</li>
                        <li>Lists (bulleted & numbered)</li>
                        <li>Undo/Redo functionality</li>
                        <li>Real-time collaboration</li>
                        <li>Mobile responsive</li>
                    </ul>
                </div>
                
                <div class="feature-list">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">TinyMCE 6 Features (With API Key)</h3>
                    <ul>
                        <li>Lightweight & fast</li>
                        <li>Rich plugin ecosystem</li>
                        <li>Advanced table editing</li>
                        <li>Media management</li>
                        <li>Code view</li>
                        <li>Full-screen mode</li>
                        <li>Word count & status bar</li>
                        <li>Image upload & management</li>
                        <li>Spell check</li>
                        <li>Accessibility features</li>
                        <li>Font size controls</li>
                        <li>Text & background colors</li>
                        <li>Emoticons support</li>
                        <li>Template system</li>
                        <li>Paste from Word/Excel</li>
                        <li>No branding/upgrade prompts</li>
                    </ul>
                </div>
            </div>

            <!-- Test Instructions -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-3">Test Instructions</h3>
                <div class="text-blue-700 space-y-2">
                    <p><strong>Try these features in both editors:</strong></p>
                    <ul class="list-disc list-inside space-y-1 ml-4">
                        <li>Edit the existing text and formatting</li>
                        <li>Add new paragraphs and headings</li>
                        <li>Create bulleted and numbered lists</li>
                        <li>Insert links and format text (bold, italic)</li>
                        <li>Edit the tables (add/remove rows/columns)</li>
                        <li>Test undo/redo functionality</li>
                        <li>Try copying and pasting content</li>
                        <li>Test on mobile devices (responsive design)</li>
                    </ul>
                </div>
            </div>

            <!-- Performance Info -->
            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Performance Comparison</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">CKEditor 5</h4>
                        <ul class="space-y-1 text-gray-600">
                            <li>• Bundle size: ~500KB</li>
                            <li>• Load time: ~2-3 seconds</li>
                            <li>• Memory usage: Medium</li>
                            <li>• Mobile performance: Good</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">TinyMCE 6</h4>
                        <ul class="space-y-1 text-gray-600">
                            <li>• Bundle size: ~300KB</li>
                            <li>• Load time: ~1-2 seconds</li>
                            <li>• Memory usage: Low</li>
                            <li>• Mobile performance: Excellent</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#ckeditor'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', '|',
                        'link', 'imageUpload', '|',
                        'undo', 'redo'
                    ]
                },
                language: 'en',
                image: {
                    toolbar: [
                        'imageTextAlternative', '|',
                        'imageStyle:alignLeft',
                        'imageStyle:alignCenter',
                        'imageStyle:alignRight'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                }
            })
            .then(editor => {
                console.log('CKEditor initialized successfully');
            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });

        // Initialize TinyMCE with full API key features
        tinymce.init({
            selector: '#tinymce',
            height: 300,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                'template', 'paste', 'textcolor', 'colorpicker', 'textpattern',
                'nonbreaking', 'pagebreak', 'directionality', 'hr'
            ],
            toolbar: 'undo redo | blocks fontsize | ' +
                'bold italic underline strikethrough | forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | ' +
                'link image media table | ' +
                'code preview fullscreen | help',
            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
            image_upload_handler: function (blobInfo, success, failure) {
                // Placeholder for image upload - you can implement actual upload logic
                setTimeout(function () {
                    success('data:image/jpeg;base64,' + blobInfo.base64());
                }, 2000);
            },
            setup: function (editor) {
                editor.on('init', function () {
                    console.log('TinyMCE initialized successfully with API key');
                });
            },
            branding: false, // Remove "Powered by TinyMCE" branding
            promotion: false, // Remove upgrade prompts
            statusbar: true, // Show status bar with word count
            resize: true, // Allow resizing
            elementpath: true, // Show element path
            contextmenu: 'link image imagetools table spellchecker configurepermanentpen',
            paste_data_images: true, // Allow pasting images
            automatic_uploads: true, // Enable automatic image uploads
            file_picker_types: 'image', // Enable file picker for images
            file_picker_callback: function (callback, value, meta) {
                // Placeholder for file picker - you can implement actual file picker
                if (meta.filetype === 'image') {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();
                    input.onchange = function () {
                        const file = this.files[0];
                        const reader = new FileReader();
                        reader.onload = function () {
                            callback(reader.result, {
                                alt: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                }
            }
        });
    </script>
</body>
</html>
