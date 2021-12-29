<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Client\BulkCreateProductAPIRequest;
use App\Http\Requests\Client\BulkUpdateProductAPIRequest;
use App\Http\Requests\Client\CreateProductAPIRequest;
use App\Http\Requests\Client\UpdateProductAPIRequest;
use App\Http\Resources\Client\ProductCollection;
use App\Http\Resources\Client\ProductResource;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class ProductController extends AppBaseController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Product's Listing API.
     * Limit Param: limit
     * Skip Param: skip.
     *
     * @param Request $request
     *
     * @return ProductCollection
     */
    public function index(Request $request): ProductCollection
    {
        $products = $this->productRepository->fetch($request);

        return new ProductCollection($products);
    }

    /**
     * Create Product with given payload.
     *
     * @param CreateProductAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return ProductResource
     */
    public function store(CreateProductAPIRequest $request): ProductResource
    {
        $input = $request->all();
        $product = $this->productRepository->create($input);

        return new ProductResource($product);
    }

    /**
     * Get single Product record.
     *
     * @param int $id
     *
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        $product = $this->productRepository->findOrFail($id);

        return new ProductResource($product);
    }

    /**
     * Update Product with given payload.
     *
     * @param UpdateProductAPIRequest $request
     * @param int                     $id
     *
     * @throws ValidatorException
     *
     * @return ProductResource
     */
    public function update(UpdateProductAPIRequest $request, int $id): ProductResource
    {
        $input = $request->all();
        $product = $this->productRepository->update($input, $id);

        return new ProductResource($product);
    }

    /**
     * Delete given Product.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->productRepository->delete($id);

        return $this->successResponse('Product deleted successfully.');
    }

    /**
     * Force Delete given Product.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function forceDelete(int $id): JsonResponse
    {
        $this->productRepository->forceDelete($id);

        return $this->successResponse('Product deleted successfully.');
    }

    /**
     * Bulk create Product's.
     *
     * @param BulkCreateProductAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return ProductCollection
     */
    public function bulkStore(BulkCreateProductAPIRequest $request): ProductCollection
    {
        $products = collect();

        $input = $request->get('data');
        foreach ($input as $key => $productInput) {
            $products[$key] = $this->productRepository->create($productInput);
        }

        return new ProductCollection($products);
    }

    /**
     * Bulk update Product's data.
     *
     * @param BulkUpdateProductAPIRequest $request
     *
     * @throws ValidatorException
     *
     * @return ProductCollection
     */
    public function bulkUpdate(BulkUpdateProductAPIRequest $request): ProductCollection
    {
        $products = collect();

        $input = $request->get('data');
        foreach ($input as $key => $productInput) {
            $products[$key] = $this->productRepository->update($productInput, $productInput['id']);
        }

        return new ProductCollection($products);
    }
}
