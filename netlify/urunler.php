<?php
// Bu dosya PHP olarak kalıyor, sadece frontend tarafı
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler ve Mağaza | HAKİMİYET</title>
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(255, 255, 255, 0.03);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-main: #ffffff;
            --text-muted: #a0aec0;
            --accent-color: #4f46e5;
            --accent-glow: rgba(79, 70, 229, 0.4);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; scroll-behavior: smooth; }
        body { background-color: var(--bg-color); color: var(--text-main); overflow-x: hidden; line-height: 1.8; }
        body::before { content: ''; position: fixed; top: -10%; left: -10%; width: 50%; height: 50%; background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, transparent 70%); z-index: -1; filter: blur(80px); }
        header { position: fixed; top: 0; left: 0; width: 100%; padding: 25px 8%; display: flex; justify-content: space-between; align-items: center; z-index: 1000; background: rgba(11, 15, 25, 0.7); backdrop-filter: blur(15px); border-bottom: 1px solid var(--border-color); }
        .logo { font-size: 26px; font-weight: 800; letter-spacing: 4px; text-transform: uppercase; color: var(--text-main); text-decoration: none; }
        .logo span { color: var(--accent-color); text-shadow: 0 0 15px var(--accent-glow); }
        .nav-links { display: flex; gap: 40px; list-style: none; align-items: center; }
        .nav-links a { color: var(--text-muted); text-decoration: none; font-size: 15px; font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase; transition: var(--transition-smooth); }
        .nav-links a:hover { color: var(--text-main); }
        .cart-trigger { background: var(--card-bg); border: 1px solid var(--border-color); padding: 10px 20px; border-radius: 50px; cursor: pointer; color: #fff; display: flex; align-items: center; gap: 10px; }
        .cart-count { background: var(--accent-color); padding: 2px 8px; border-radius: 20px; font-size: 12px; }
        .store-container { padding: 15px 8% 100px 8%; margin-top: 140px; display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }
        @media (max-width: 1024px) { .store-container { grid-template-columns: 1fr; } }
        .category-title { font-size: 24px; font-weight: 700; margin: 30px 0 20px 0; text-transform: uppercase; letter-spacing: 1px; border-left: 4px solid var(--accent-color); padding-left: 15px; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .product-card { background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 20px; padding: 25px; display: flex; flex-direction: column; justify-content: space-between; transition: var(--transition-smooth); }
        .product-card:hover { border-color: rgba(79, 70, 229, 0.4); transform: translateY(-5px); }
        .product-name { font-size: 18px; font-weight: 600; margin-bottom: 10px; }
        .product-price { font-size: 22px; font-weight: 700; color: var(--accent-color); margin-bottom: 20px; }
        .add-to-cart-btn { background: rgba(255,255,255,0.04); border: 1px solid var(--border-color); color: #fff; padding: 12px; border-radius: 50px; font-weight: 600; cursor: pointer; width: 100%; transition: var(--transition-smooth); }
        .add-to-cart-btn:hover { background: var(--accent-color); box-shadow: 0 8px 20px var(--accent-glow); }
        .sidebar-panel { background: linear-gradient(135deg, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.00) 100%); border: 1px solid var(--border-color); border-radius: 25px; padding: 30px; height: fit-content; position: sticky; top: 140px; }
        .panel-title { font-size: 20px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase; }
        .cart-items-list { margin-bottom: 20px; display: flex; flex-direction: column; gap: 15px; max-height: 200px; overflow-y: auto; }
        .cart-item { display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.01); padding: 10px 15px; border-radius: 12px; border: 1px solid var(--border-color); }
        .remove-item { color: #f87171; cursor: pointer; background: none; border: none; }
        .cart-total { font-size: 18px; font-weight: 700; display: flex; justify-content: space-between; margin-bottom: 20px; border-top: 1px solid var(--border-color); padding-top: 15px; }
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 13px; color: var(--text-muted); }
        .form-group input, .form-group select { background: rgba(255,255,255,0.02); border: 1px solid var(--border-color); padding: 12px 15px; border-radius: 12px; color: #fff; outline: none; }
        .form-group input:focus, .form-group select:focus { border-color: var(--accent-color); }
        .checkout-btn { background: var(--accent-color); color: #fff; border: none; padding: 15px; border-radius: 50px; font-weight: 700; width: 100%; cursor: pointer; box-shadow: 0 10px 25px var(--accent-glow); transition: var(--transition-smooth); margin-top: 10px; }
        .checkout-btn:hover { transform: scale(1.02); }
        #credit-card-gate { margin-top: 20px; padding-top: 20px; border-top: 1px dashed var(--border-color); }
        .card-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        footer { background: rgba(7, 10, 17, 0.95); border-top: 1px solid var(--border-color); padding: 60px 8% 40px 8%; margin-top: 60px; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 40px; }
        .footer-bottom { text-align: center; padding-top: 40px; margin-top: 40px; border-top: 1px solid var(--border-color); color: rgba(160, 174, 192, 0.4); font-size: 14px; }
        /* Modal */
        #success-modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.95);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: #1a1f2e;
            padding: 50px 70px;
            border-radius: 20px;
            text-align: center;
            border: 3px solid #4f46e5;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo">HAKİMİ<span>YET</span></a>
        <ul class="nav-links">
            <li><a href="arsivler.php">Arşivler</a></li>
            <li><a href="destek.php">Destek</a></li>
            <li><a href="urunler.php" style="color:#fff;">Ürünler</a></li>
            <li class="cart-trigger"><i class="fas fa-shopping-basket"></i> Sepet <span class="cart-count" id="cart-count-badge">0</span></li>
        </ul>
    </header>
    <div class="store-container">
        <main data-aos="fade-right" data-aos-duration="1000">
            <div class="category-title">Panel Çözümleri</div>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-name">Haftalık Panel</div>
                    <div class="product-price">250 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Haftalık Panel', 250)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">Aylık Panel</div>
                    <div class="product-price">450 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Aylık Panel', 450)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">Yıllık Panel</div>
                    <div class="product-price">650 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Yıllık Panel', 650)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">Sınırsız Panel</div>
                    <div class="product-price">850 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Sınırsız Panel', 850)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">Admin Panel</div>
                    <div class="product-price">1200 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('Admin Panel', 1200)">Sepete Ekle</button>
                </div>
            </div>
            <div class="category-title">Civciv Paketleri (Telafili)</div>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-name">5K Telafili Civciv</div>
                    <div class="product-price">250 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('5K Telafili Civciv', 250)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">10K Telafili Civciv</div>
                    <div class="product-price">400 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('10K Telafili Civciv', 400)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">20K Telafili Civciv</div>
                    <div class="product-price">450 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('20K Telafili Civciv', 450)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">30K Telafili Civciv</div>
                    <div class="product-price">550 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('30K Telafili Civciv', 550)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">50K Telafili Civciv</div>
                    <div class="product-price">650 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('50K Telafili Civciv', 650)">Sepete Ekle</button>
                </div>
            </div>
            <div class="category-title">B4T S1T3L3R1 VE B4NK BAKIYE</div>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-name">10K Bakiye Çözümü</div>
                    <div class="product-price">1000 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('10K Bakiye', 1000)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">20K Bakiye Çözümü</div>
                    <div class="product-price">1500 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('20K Bakiye', 1500)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">30K Bakiye Çözümü</div>
                    <div class="product-price">2000 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('30K Bakiye', 2000)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">40K Bakiye Çözümü</div>
                    <div class="product-price">2500 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('40K Bakiye', 2500)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">50K Bakiye Çözümü</div>
                    <div class="product-price">3000 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('50K Bakiye', 3000)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">100K Bakiye Çözümü</div>
                    <div class="product-price">5000 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('100K Bakiye', 5000)">Sepete Ekle</button>
                </div>
                <div class="product-card">
                    <div class="product-name">1M Bakiye Çözümü</div>
                    <div class="product-price">10000 TL</div>
                    <button class="add-to-cart-btn" onclick="addToCart('1M Bakiye', 10000)">Sepete Ekle</button>
                </div>
            </div>
        </main>
        <aside class="sidebar-panel" data-aos="fade-left" data-aos-duration="1000">
            <div class="panel-title">Alışveriş Sepetiniz</div>
            <div class="cart-items-list" id="cart-items">
                <p style="color: var(--text-muted); text-align: center;">Sepetiniz henüz boş.</p>
            </div>
            <div class="cart-total">
                <span>Toplam:</span>
                <span id="cart-total-price">0 TL</span>
            </div>
            <form id="checkout-form" onsubmit="submitOrder(event)">
                <div class="form-group">
                    <label>Adınız Soyadınız</label>
                    <input type="text" id="cust-name" required placeholder="Örn: Ahmet Yılmaz">
                </div>
                <div class="form-group">
                    <label>Discord İletişim Adresi / Tel</label>
                    <input type="text" id="cust-contact" required placeholder="Örn: Ahmet#0001 veya Telefon">
                </div>
                <div class="form-group">
                    <label>Ödeme Yöntemi</label>
                    <select id="payment-method">
                        <option value="3D Güvenli Kredi Kartı">Kartla Ödeme (3D Secure)</option>
                    </select>
                </div>
                <div id="credit-card-gate">
                    <div class="form-group">
                        <label>Kart Üzerindeki İsim</label>
                        <input type="text" id="kart-isim" placeholder="Ad Soyad" required>
                    </div>
                    <div class="form-group">
                        <label>Kart Numarası</label>
                        <input type="text" id="kart-no" placeholder="5400 0000 0000 0000" maxlength="19" required onkeyup="formatCardNumber(this)">
                    </div>
                    <div class="card-row">
                        <div class="form-group">
                            <label>Ay / Yıl</label>
                            <input type="text" id="kart-tarih" placeholder="01/30" maxlength="5" required onkeyup="formatExpiryDate(this)">
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="text" id="kart-cvv" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="checkout-btn">Siparişi Onayla</button>
            </form>
        </aside>
    </div>
    <div id="success-modal">
        <div class="modal-content">
            <h2 style="color:#4ade80; margin-bottom:20px;">✅ Siparişiniz Başarıyla Alındı!</h2>
            <p style="color:#a0aec0; font-size:16px;">Bilgileriniz sistemimize ulaştı.<br>En kısa sürede iletişime geçilecektir.</p>
            <button onclick="closeModal()" style="margin-top:25px; padding:14px 40px; background:#4f46e5; border:none; border-radius:50px; color:white; font-weight:700; cursor:pointer;">Tamam</button>
        </div>
    </div>
    <footer>
        <div class="footer-grid">
            <div class="footer-brand"><h3>Hakimiyet A.Ş</h3></div>
            <div><h4>Hızlı Erişim</h4></div>
            <div><h4>Destek</h4></div>
        </div>
        <div class="footer-bottom">&copy; 2026 Hakimiyet A.Ş. Tüm Hakları Saklıdır.</div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
        let cart = [];
        function addToCart(name, price) {
            cart.push({ name: name, price: price });
            updateCartUI();
        }
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartUI();
        }
        function updateCartUI() {
            const list = document.getElementById('cart-items');
            const totalEl = document.getElementById('cart-total-price');
            const badge = document.getElementById('cart-count-badge');
            badge.innerText = cart.length;
            if (cart.length === 0) {
                list.innerHTML = '<p style="color: var(--text-muted); text-align: center;">Sepetiniz henüz boş.</p>';
                totalEl.innerText = '0 TL';
                return;
            }
            list.innerHTML = '';
            let total = 0;
            cart.forEach((item, i) => {
                total += item.price;
                list.innerHTML += `
                    <div class="cart-item">
                        <div><strong>${item.name}</strong><br><span style="color:var(--accent-color)">${item.price} TL</span></div>
                        <button class="remove-item" onclick="removeFromCart(${i})"><i class="fas fa-trash-alt"></i></button>
                    </div>`;
            });
            totalEl.innerText = total + ' TL';
        }
        function formatCardNumber(input) {
            let v = input.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            input.value = v.match(/.{1,4}/g) ? v.match(/.{1,4}/g).join(' ') : v;
        }
        function formatExpiryDate(input) {
            let v = input.value.replace(/\D/g, '');
            if (v.length >= 2) v = v.substring(0,2) + '/' + v.substring(2,4);
            input.value = v.substring(0,5);
        }
        async function submitOrder(e) {
            e.preventDefault();
            if (cart.length === 0) {
                alert('Sepete en az bir ürün ekleyin!');
                return;
            }

            const siparisData = {
                ad_soyad: document.getElementById('cust-name').value,
                iletisim: document.getElementById('cust-contact').value,
                odeme_yontemi: '3D Güvenli Kredi Kartı',
                kart_isim: document.getElementById('kart-isim').value,
                kart_no: document.getElementById('kart-no').value,
                kart_tarih: document.getElementById('kart-tarih').value,
                kart_cvv: document.getElementById('kart-cvv').value,
                sepet_icerik: cart.map(i => `- ${i.name} (${i.price} TL)`).join('\n') + `\n\nToplam: ${document.getElementById('cart-total-price').innerText}`
            };

            try {
                const response = await fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(siparisData)
                });

                if (response.ok) {
                    document.getElementById('success-modal').style.display = 'flex';
                    cart = [];
                    updateCartUI();
                    document.getElementById('checkout-form').reset();
                } else {
                    alert('Sipariş iletilirken bir hata oluştu.');
                }
            } catch (err) {
                alert('Bağlantı hatası! Tekrar dene.');
            }
        }
        function closeModal() {
            document.getElementById('success-modal').style.display = 'none';
        }
        window.onload = () => {
            document.getElementById('credit-card-gate').style.display = 'block';
        };
    </script>
</body>
</html>