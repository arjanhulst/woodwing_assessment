<?php

namespace App\Controller;

use App\Domain\Distance\Service\DistanceCalculator;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use ApiException;

/**
 * Class CalculationController
 * @package App\Controller
 */
class CalculationController
{
    /**
     * This request adds up two distances in varying units
     *
     * @Route("/api/add-up-distance", methods={"GET","POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Adds up 2 distances",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Distance::class))
     *     )
     * )
     * @SWG\Parameter(
     *     name="distances",
     *     in="query",
     *     type="array",
     *     description="An array of distances"
     * )
     * @SWG\Parameter(
     *     name="return_unit",
     *     in="query",
     *     type="integer",
     *     description="The unit to convert the distance to"
     * )
     * @SWG\Tag(name="calculate-distance")
     *
     * @param Request $request
     * @param DistanceCalculator $calculator
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function calculateDistanceAction(Request $request, DistanceCalculator $calculator, SerializerInterface $serializer)
    {
        $distances = $request->get('distances', []);
        $returnUnit = $request->get('returnUnit', false);
        $distance = $calculator->addUp($distances, $returnUnit);
        if (count($distances) < 2 || !$returnUnit) {
            throw new ApiException('Missing required parameters', 400);
        }
        return new JsonResponse($serializer->serialize($distance, 'json'), 200, [], true);
    }
}