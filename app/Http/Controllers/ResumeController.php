<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Stemmers\PorterStemmer;
use NlpTools\Similarity\CosineSimilarity;
use League\Csv\Reader;


class ResumeController extends Controller
{
    public function analyze(Request $request)
{
    // Get the job description text, uploaded resume file, and guide resume file
    $jobDescription = $request->input('job_description');
    $resumeFile = $request->file('resume');
    $guideResumeFile = $request->file('guide_resume');

    // Save the uploaded resume to a temporary location
    $resumePath = $resumeFile->store('temp');

    // Read the resume file using PhpSpreadsheet
    $reader = IOFactory::createReaderForFile(storage_path('app/' . $resumePath));
    $spreadsheet = $reader->load(storage_path('app/' . $resumePath));
    $sheet = $spreadsheet->getActiveSheet();

    // Extract resume text from the spreadsheet
    $resumeText = '';
    foreach ($sheet->getRowIterator() as $row) {
        foreach ($row->getCellIterator() as $cell) {
            $resumeText .= $cell->getValue() . ' ';
        }
    }

    // Load the guide resume file
    $guideResumeText = '';
    if ($guideResumeFile) {
        $guideResumeText = file_get_contents($guideResumeFile->getPathname());
    } else {
        // Handle case when guide resume is not provided
        return response()->json(['error' => 'Guide resume not provided.']);
    }

    // Tokenize and stem the resume, guide resume, and job description texts
    $tokenizer = new WhitespaceTokenizer();
    $stemmer = new PorterStemmer();
    $resumeTokens = $tokenizer->tokenize($resumeText);
    $guideResumeTokens = $tokenizer->tokenize($guideResumeText);
    $jobDescriptionTokens = $tokenizer->tokenize($jobDescription);
    $resumeStems = $stemmer->stemEach($resumeTokens);
    $guideResumeStems = $stemmer->stemEach($guideResumeTokens);
    $jobDescriptionStems = $stemmer->stemEach($jobDescriptionTokens);

    // Calculate the similarity between resume and guide resume using the Cosine similarity measure
    $resumeGuideResumeSimilarity = CosineSimilarity::similarity(
        $resumeStems,
        $guideResumeStems
    );

    // Calculate the similarity between resume and job description using the Cosine similarity measure
    $resumeJobDescriptionSimilarity = CosineSimilarity::similarity(
        $resumeStems,
        $jobDescriptionStems
    );

    // Delete the temporary resume file
    unlink(storage_path('app/' . $resumePath));

    // Return the similarity scores as a response
    return response()->json([
        'resume_guide_resume_similarity' => $resumeGuideResumeSimilarity,
        'resume_job_description_similarity' => $resumeJobDescriptionSimilarity,
    ]);
}

}
