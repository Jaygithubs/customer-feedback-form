<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<form action="submit.php" method="POST" class="bg-white p-6 rounded-lg shadow-md w-96">
    
    <h2 class="text-2xl font-bold mb-4 text-center text-orange-500">
        Customer Feedback
    </h2>

    <input type="text" name="name" placeholder="Your Name" required
        class="w-full mb-3 p-2 border rounded">

    <input type="email" name="email" placeholder="Your Email" required
        class="w-full mb-3 p-2 border rounded">

    <textarea name="message" placeholder="Your Feedback" required
        class="w-full mb-3 p-2 border rounded"></textarea>

    <select name="rating" class="w-full mb-3 p-2 border rounded">
        <option value="5">Excellent</option>
        <option value="4">Good</option>
        <option value="3">Average</option>
        <option value="2">Poor</option>
        <option value="1">Bad</option>
    </select>

    <button class="w-full bg-orange-500 text-white p-2 rounded hover:bg-orange-600">
        Submit Feedback
    </button>

</form>

</body>
</html>