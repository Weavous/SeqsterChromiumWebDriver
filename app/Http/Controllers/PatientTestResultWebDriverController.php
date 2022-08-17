<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserWebDriverDocumentRequest;
use App\Services\WebDriver\Network\QuestNetwork;
use App\Services\WebDriver\Network\User;
use Exception;
use HeadlessChromium\Exception\OperationTimedOut;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PatientTestResultWebDriverController extends Controller
{
    public function store(UserWebDriverDocumentRequest $request): JsonResponse
    {
        try {
            QuestNetwork::create()->documents(new User($request->login, $request->secret));
        } catch (Exception | OperationTimedOut $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_REQUEST_TIMEOUT);
        }

        $url = url(sprintf("api/web-driver/patient/documents/%s", $request->login));

        return new JsonResponse(sprintf("The documents were saved successfully. You can access them in %s", $url));
    }

    public function show(Request $request): JsonResponse
    {
        $collection = Storage::disk('public')->files(
            sprintf('users/%s/documents', $request->login)
        );

        $list = array_map(function (string $file): string {
            return url(sprintf('storage/%s', $file));
        }, $collection);

        return new JsonResponse($list);
    }
}
