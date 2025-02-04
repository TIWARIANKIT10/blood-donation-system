<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-danger">Blood Request</h1>

        <form action="" method="post" class="border p-4 shadow-sm rounded bg-light">
            <div class="mb-3">
                <label for="blood_group" class="form-label">Blood Group</label>
                <select name="blood_group" class="form-select" required>
                    <option value="a+">A+</option>
                    <option value="a-">A-</option>
                    <option value="b+">B+</option>
                    <option value="b-">B-</option>
                    <option value="ab+">AB+</option>
                    <option value="ab-">AB-</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="units" class="form-label">Units</label>
                <input type="number" name="number_units" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="reason" class="form-label">Reason</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
