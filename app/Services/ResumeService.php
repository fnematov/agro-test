<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Resume;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeService
{
    private UploadService $uploadService;

    public function __construct()
    {
        $this->uploadService = new UploadService();
    }

    /**
     * @throws \Exception
     */
    public function create(Employee $employee, array $data)
    {
        try {
            $data['avatar'] = $data['avatar'] ? $this->uploadService->uploadFileAndGetName($data['avatar']) : null;
            $worked_places = $data['worked_places'] ?? [];
            $positions = $this->normalizePositions($data['positions'] ?? []);
            $portfolios = $this->normalizePortfolios($data['portfolio'] ?? []);

            DB::beginTransaction();
            $resume = $employee->resumes()->create($data);
            $resume->workedPlaces()->createMany($worked_places);
            $resume->positionsPrimary()->createMany($positions);
            $portfolios->each(function ($portfolio) use ($resume) {
                $createdPortfolio = $resume->portfolios()->create($portfolio);
                $createdPortfolio->files()->createMany($portfolio['images']);
            });
            DB::commit();
        } catch (\Exception $e) {
            Log::error("Unable to create resume. Error: " . $e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Resume $resume, array $data)
    {
        try {
            $data['avatar'] = $this->uploadService->uploadFileAndGetName($data['avatar']);
            $worked_places = $data['worked_places'] ?? [];
            $positions = $this->normalizePositions($data['positions'] ?? []);
            $portfolios = $this->normalizePortfolios($data['portfolio'] ?? []);

            DB::beginTransaction();
            $resume->fill($data);
            $resume->save();
            $resume->workedPlaces()->delete();
            $resume->workedPlaces()->createMany($worked_places);
            $resume->positionsPrimary()->delete();
            $resume->positionsPrimary()->createMany($positions);
            $resume->portfolios()->delete();
            $portfolios->each(function ($portfolio) use ($resume) {
                $createdPortfolio = $resume->portfolios()->create($portfolio);
                $createdPortfolio->files()->createMany($portfolio['images']);
            });
            DB::commit();
        } catch (\Exception $e) {
            Log::error("Unable to create resume. Error: " . $e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }

    private function normalizePortfolios($portfolios): \Illuminate\Support\Collection
    {
        return collect($portfolios)->map(function ($portfolio) {
            $images = $portfolio['images'] ? $this->uploadService->uploadFilesAndGetNames($portfolio['images']) : [];
            $portfolio['images'] = collect($images)->map(function ($image) {
                return [
                    'path' => $image
                ];
            });
            return $portfolio;
        });
    }

    private function normalizePositions($positions): \Illuminate\Support\Collection
    {
        return collect($positions)->map(function ($position) {
            return [
                'position_id' => $position
            ];
        });
    }
}
