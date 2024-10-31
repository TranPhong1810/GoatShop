<?php

namespace App\Repositories;

use App\Models\Color;
use App\Models\Size;
use App\Repositories\Interfaces\VariantRepositoryInterface as InterfacesVariantRepositoryInterface;
use App\Repositories\BaseRepository;

class VariantRepository extends BaseRepository implements InterfacesVariantRepositoryInterface
{
    protected $colorModel;
    protected $sizeModel;

    public function __construct(Color $colorModel, Size $sizeModel)
    {
        $this->colorModel = $colorModel;
        $this->sizeModel = $sizeModel;
    }

    public function createSize(array $data)
    {
        return $this->sizeModel->create($data);
    }

    public function createColor(array $data)
    {
        return $this->colorModel->create($data);
    }

    public function allColors()
    {
        return $this->colorModel->all();
    }

    public function allSizes()
    {
        return $this->sizeModel->all();
    }

    public function deleteVariant($id, $type)
    {
        if ($type === 'color') {
            $variant = Color::findOrFail($id);
        } elseif ($type === 'size') {
            $variant = Size::findOrFail($id);
        } else {
            throw new \Exception('Invalid variant type');
        }

        return $variant->delete();
    }

}

