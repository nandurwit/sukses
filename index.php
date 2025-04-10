<!DOCTYPE html>
<html lang="en">

// Array of updated technology-related images and descriptions from Pexels and Pixabay with smaller resolution images
$tech_images = [
    [
        'url' => 'https://cdn.pixabay.com/photo/2017/08/10/07/32/network-2619755_640.jpg', // Data Security
        'description' => 'Data security is critical in protecting information in the digital age.'
    ],
    [
        'url' => 'https://cdn.pixabay.com/photo/2018/03/08/11/55/blockchain-3206918_640.jpg', // Blockchain Technology
        'description' => 'Blockchain is securing transactions and creating new opportunities in finance.'
    ],
    [
        'url' => 'https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350', // AI and Machine Learning
        'description' => 'Artificial Intelligence and Machine Learning are revolutionizing industries worldwide.'
    ],
    [
        'url' => 'https://images.pexels.com/photos/546819/pexels-photo-546819.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=350', // Coding and Software Development
        'description' => 'Software development is at the heart of technological innovation.'
    ]
];

// Read URLs from the text file into an array
$links = file('redirect_url.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Choose whether to use random or sequential link selection
$use_random = true; // Change to false if you want sequential rotation

if ($use_random) {
    $selected_link = $links[array_rand($links)];
} else {
    if (!isset($_SESSION['link_index'])) {
        $_SESSION['link_index'] = 0;
    } else {
        $_SESSION['link_index'] = ($_SESSION['link_index'] + 1) % count($links);
    }
    $selected_link = $links[$_SESSION['link_index']];
}

// Randomly select an image and description from the array
$selected_image = $tech_images[array_rand($tech_images)];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukses!</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .countdown {
            font-size: 24px;
            margin-top: 20px;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .ads-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <img src="login.png" alt="Sukses Login Image" class="img-fluid">
        <h1 class="my-4">Sukses!</h1>
        <p>Anda akan dialihkan dalam <span id="countdown">5</span> detik.</p>
        <h2 class="my-4">Artikel tentang Teknologi</h2>
        <p><?= $selected_image['description'] ?></p>
        <img src="<?= $selected_image['url'] ?>" alt="Gambar Teknologi" class="img-fluid my-4">

        <div class="ads-section">
            <script type="text/javascript">
                atOptions = {
                    'key' : '4cfe1766cf8d16ed0970403f3fc28cd7',
                    'format' : 'iframe',
                    'height' : 300,
                    'width' : 160,
                    'params' : {}
                };
            </script>
            <script type="text/javascript" src="//www.highperformanceformat.com/4cfe1766cf8d16ed0970403f3fc28cd7/invoke.js"></script>
            <script async="async" data-cfasync="false" src="//pl24778969.effectiveratecpm.com/8e08bc60e4c7fef6bc05fdf3557f6105/invoke.js"></script>
            <div id="container-8e08bc60e4c7fef6bc05fdf3557f6105"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Countdown interaktif selama 5 detik
    let countdownElement = document.getElementById('countdown');
    let countdownValue = parseInt(countdownElement.innerText);

    let countdownInterval = setInterval(function() {
        countdownValue--;
        countdownElement.innerText = countdownValue;
        if (countdownValue === 0) {
            clearInterval(countdownInterval);

            // Redirect to the selected URL
            window.location.href = '<?= $selected_link ?>';
            
            // Hanya menghitung kunjungan setelah pengalihan berhasil
            fetch('update_counter.php')
                .then(response => response.text())
                .then(data => {
                    console.log('Visitor count updated:', data);
                });
        }
    }, 1000);
</script>
</body>
</html>
