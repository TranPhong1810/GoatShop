<?php

namespace App\Services;

use App\Models\Color;
use App\Repositories\VariantRepository;
use App\Services\Interfaces\VariantServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services
 */
class VariantService implements VariantServiceInterface
{
    protected $variantRepository;

    public function __construct(VariantRepository $variantRepository)
    {
        $this->variantRepository = $variantRepository;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $dataCreate = $request->all();
            if (isset($dataCreate['code']) && !empty($dataCreate['code'])) {
                $createColor = $this->variantRepository->createColor($dataCreate);
            }else{
                $createSize = $this->variantRepository->createSize($dataCreate);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }
    public function update($id,$request)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            echo $e->getMessage(); // Xử lý lỗi
            return false;
        }
    }


    public function deleteColor($id)
{
    DB::beginTransaction();
    try {
        $variant = $this->variantRepository->deleteVariant($id, 'color'); 
        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage());
        echo $e->getMessage();
        return false;
    }
}

public function deleteSize($id)
{
    DB::beginTransaction();
    try {
        $variant = $this->variantRepository->deleteVariant($id, 'size');
        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage());
        echo $e->getMessage();
        return false;
    }
}


}
