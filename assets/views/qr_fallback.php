<!-- QR Code Scanner Fallback - File Input Method -->
<div class="card qr-fallback-card">
    <h3 class="card-title">
        <i class="fa-solid fa-qrcode"></i> Scan QR Code Alternatif
    </h3>
    
    <p class="fallback-description">
        Jika kamera tidak dapat diakses, Anda dapat upload gambar QR code:
    </p>
    
    <div class="upload-section">
        <div class="upload-box" onclick="document.getElementById('qr-file-input').click()">
            <div class="upload-content">
                <div class="upload-icon">
                    <i class="fa-solid fa-upload"></i>
                </div>
                <div class="upload-text">Klik untuk upload QR Code</div>
                <div class="upload-subtext">PNG, JPG hingga 5MB</div>
            </div>
            <img id="qr-preview" class="preview-img" src="" alt="QR Preview">
            <input type="file" id="qr-file-input" hidden accept="image/*" onchange="handleQRFile(this)">
        </div>
    </div>
    
    <div id="qr-result"></div>
</div>

<style>
.qr-fallback-card {
    margin-bottom: 20px;
    border: 2px dashed #cbd5e1;
    background-color: #f8fafc;
}

.fallback-description {
    color: #64748b;
    margin-bottom: 15px;
    font-size: 14px;
}

.upload-section {
    margin: 15px 0;
}

.upload-box {
    background-color: #f1f5f9;
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.upload-box:hover {
    border-color: #008855;
    background-color: #f0fdf4;
}

.upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    text-align: center;
}

.upload-icon {
    font-size: 32px;
    color: #64748b;
    margin-bottom: 10px;
}

.upload-text {
    font-size: 14px;
    color: #475569;
    font-weight: 500;
    margin-bottom: 5px;
}

.upload-subtext {
    font-size: 12px;
    color: #94a3b8;
}

.preview-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    position: absolute;
    top: 0;
    left: 0;
    display: none;
    background-color: white;
}

#qr-result {
    margin-top: 15px;
}

.qr-processing {
    background-color: #e0f2fe;
    color: #0284c7;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
}

.qr-success {
    background-color: #f0fdf4;
    color: #16a34a;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
}

.qr-error {
    background-color: #fef2f2;
    color: #dc2626;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
}
</style>

<script>
// Load QR code parsing library
function loadQRLibrary() {
    return new Promise((resolve, reject) => {
        if (typeof jsQR !== 'undefined') {
            resolve();
            return;
        }
        
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js';
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

async function handleQRFile(input) {
    const file = input.files[0];
    if (!file) return;
    
    const preview = document.getElementById('qr-preview');
    const result = document.getElementById('qr-result');
    
    // Show preview
    const reader = new FileReader();
    reader.onload = async function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        document.querySelector('.upload-content').style.display = 'none';
        
        // Show processing
        result.innerHTML = '<div class="qr-processing">🔄 Memproses QR Code...</div>';
        
        try {
            await loadQRLibrary();
            
            // Create image element to get image data
            const img = new Image();
            img.onload = function() {
                // Create canvas to get image data
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height);
                
                if (code) {
                    console.log('QR Code detected:', code.data);
                    result.innerHTML = `<div class="qr-success">✅ QR Code terdeteksi: ${code.data}</div>`;
                    
                    // Verify QR code
                    verifyQRCode(code.data);
                } else {
                    result.innerHTML = '<div class="qr-error">❌ QR Code tidak terdeteksi. Pastikan gambar jelas dan QR code terlihat dengan baik.</div>';
                }
            };
            
            img.src = e.target.result;
            
        } catch (error) {
            console.error('QR processing error:', error);
            result.innerHTML = '<div class="qr-error">❌ Gagal memproses QR Code. Silakan coba lagi.</div>';
        }
    };
    
    reader.readAsDataURL(file);
}

function resetQRUpload() {
    document.getElementById('qr-file-input').value = '';
    document.getElementById('qr-preview').style.display = 'none';
    document.getElementById('qr-preview').src = '';
    document.querySelector('.upload-content').style.display = 'flex';
    document.getElementById('qr-result').innerHTML = '';
}

// Add reset function to global scope
window.resetQRUpload = resetQRUpload;
</script>
