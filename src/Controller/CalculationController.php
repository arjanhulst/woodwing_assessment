<?php

namespace App\Controller;

use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use InvalidArgumentException;

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
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function calculateDistanceAction(Request $request, SerializerInterface $serializer)
    {
            $distances = $request->get('distances',[]);
            $returnUnit = $request->get('returnUnit', false);
            if (count($distances) < 2 || !$returnUnit) {
                return new JsonResponse(['message' => 'Missing required parameters'], 400);
            }
        return new JsonResponse($serializer->serialize($distances, 'json'), 200, [], true);
    }
}