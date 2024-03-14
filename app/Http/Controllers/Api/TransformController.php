<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AlternateCaseText;
use App\Services\UpperCaseText;
use App\Services\CommaSeparatorText;
use App\Helpers\TextTransformerHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransformFormRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Response;

class TransformController extends Controller
{
    use ApiResponseTrait;

    /**
     * Transform the text
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function transform(TransformFormRequest $request)
    {
        try {
            $text = $request->input('text');

            // Transform the text
            $tranformedText = (new TextTransformerHelper(
                [
                    new UpperCaseText($text),
                    new AlternateCaseText($text),
                ]
            ))->transform()->getOutput();

            // Export the transformed text to a CSV file
            $exportPath = (new TextTransformerHelper(
                new CommaSeparatorText($text)
            ))->transform()->export();

            return $this->successResponse(
                [
                    "transformed_text" => $tranformedText,
                    "export_path" => $exportPath,
                ],
                "Text Transformed Successfully"
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                [
                    'message' => 'An error occurred while processing the request. Please try again.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
