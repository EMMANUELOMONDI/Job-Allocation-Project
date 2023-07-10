<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="{{ route('resume.analyze') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <label for="job_description">Job Description:</label>
            <textarea name="job_description" id="job_description" rows="5"></textarea>
        
            <label for="resume">Resume:</label>
            <input type="file" name="resume" id="resume">
        
            <button type="submit">Analyze Resume</button>
        </form>
    </div>
</body>
</html>
