<!DOCTYPE html>
<html>

<head>
<<<<<<< HEAD
    <title>Add Disaster List</title>
    @vite('./public/css/style.css')
</head>

<body>
    <h1 class="text-2xl font-semibold text-cyan-500">Add Disaster List</h1>
=======
    <title>Create Disaster</title>
    @vite('public/css/style.css')
</head>

<body>
    <h1 class="">Create Disaster</h1>
>>>>>>> f86eac4ba251b98a09dc1dd48fd22c79eb7aa83e

    <form method="POST" action="{{ route('disaster.store') }}">
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input type="text" id="code" name="code" required><br>
        <br>

        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
        <br>

        <label for="start_date">Start Date:</label>
        @error('start_date')
            {{ $message }}
        @enderror
        <input type="date" id="start_date" name="start_date" required><br>
        <br>

        <label for="end_date">End Date:</label>
        @error('end_date')
            {{ $message }}
        @enderror
        <input type="date" id="end_date" name="end_date"><br>
        <br>

        <label for="closed_date">Closed Date:</label>
        @error('closed_date')
            {{ $message }}
        @enderror
        <input type="date" id="closed_date" name="closed_date"><br>
        <br>

        <label for="lat">Lat:</label>
        @error('lat')
            {{ $message }}
        @enderror
        <input type="text" id="lat" name="lat" required><br>
        <br>

        <label for="long">Long:</label>
        @error('long')
            {{ $message }}
        @enderror
        <input type="text" id="long" name="long" required><br>
        <br>

        <button type="submit">
            <h4>Save Data</h4>
        </button>
    </form>
</body>

</html>
