<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="maint">
    <h1>Fejlesztés alatt 🔧</h1>
    <p>Dolgozunk az oldalon — hamarosan visszatérünk!</p>
</div>

<style>
.maint {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 80vh;
    background-color: #28a745;
    color: #fff;
    font-family: Arial, sans-serif;
    text-align: center;
    border-radius: 12px;
    margin: 2rem;
    padding: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
}
.maint:hover {
    transform: scale(1.03);
}
.maint h1 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}
.maint p {
    font-size: 1.1rem;
    opacity: 0.9;
}
</style>

</body>
</html>
