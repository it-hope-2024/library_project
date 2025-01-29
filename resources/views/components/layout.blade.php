<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libray Center</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body >
<x-navbar></x-navbar>
<main class="py-8 px-4 mx-auto max-w-screen-lg ">
    <div >
     
    {{{$slot }}}
    </div>
  </main>
  <x-footer></x-footer>
</body>
</html>
 