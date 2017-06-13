<?php namespace App\Http\Controllers;

use App\Data\Models\Post as Model;
use App\Json\Api\PostsApi as Api;
use App\Json\Schemes\PostScheme as Scheme;
use App\Json\Validators\PostsValidator as Validator;
use Limoncello\Flute\Http\BaseController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @package App
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class PostsController extends BaseController
{
    /** @inheritdoc */
    const API_CLASS = Api::class;

    /** @inheritdoc */
    const SCHEMA_CLASS = Scheme::class;

    /**
     * @inheritdoc
     */
    public static function parseInputOnCreate(
        ContainerInterface $container,
        ServerRequestInterface $request
    ): array {
        return static::prepareCaptures(
            Validator::onCreateValidator($container)
                ->assert(static::parseJson($container, $request))
                ->getCaptures(),
            Model::FIELD_ID,
            Validator::captureNames()
        );
    }

    /**
     * @inheritdoc
     */
    public static function parseInputOnUpdate(
        $index,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): array {
        $captures = Validator::onUpdateValidator($index, $container)
            ->assert(static::parseJson($container, $request))
            ->getCaptures();

        return static::prepareCaptures(
            $captures,
            Model::FIELD_ID,
            Validator::captureNames()
        );
    }

    /**
     * @param array                  $routeParams
     * @param ContainerInterface     $container
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public static function readComments(
        array $routeParams,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): ResponseInterface {
        $index    = $routeParams[static::ROUTE_KEY_INDEX];
        $response = static::readRelationship($index, Scheme::REL_COMMENTS, $container, $request);

        return $response;
    }
}
