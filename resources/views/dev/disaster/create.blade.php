<!DOCTYPE html>
<html>

<head>
    <title>Create Disaster</title>
</head>

<body>
    <h1>Create Disaster</h1>

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
