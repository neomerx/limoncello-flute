<?php namespace App\Data\Models;

use Doctrine\DBAL\Types\Type;
use Limoncello\Contracts\Application\ModelInterface;
use Limoncello\Flute\Types\JsonApiDateTimeType;
use Limoncello\Passport\Entities\Scope;

/**
 * @package App
 */
class RoleScope implements ModelInterface, CommonFields
{
    /** Table name */
    const TABLE_NAME = 'roles_scopes';

    /** Primary key */
    const FIELD_ID = 'id_role_scope';

    /** Field name */
    const FIELD_ID_ROLE = Role::FIELD_ID;

    /** Field name */
    const FIELD_ID_SCOPE = Scope::FIELD_ID;

    /**
     * @inheritdoc
     */
    public static function getTableName()
    {
        return static::TABLE_NAME;
    }

    /**
     * @inheritdoc
     */
    public static function getPrimaryKeyName()
    {
        return static::FIELD_ID;
    }

    /**
     * @inheritdoc
     */
    public static function getAttributeTypes()
    {
        return [
            self::FIELD_ID         => Type::INTEGER,
            self::FIELD_ID_ROLE    => Type::STRING,
            self::FIELD_ID_SCOPE   => Type::STRING,
            self::FIELD_CREATED_AT => JsonApiDateTimeType::NAME,
            self::FIELD_UPDATED_AT => JsonApiDateTimeType::NAME,
            self::FIELD_DELETED_AT => JsonApiDateTimeType::NAME,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getAttributeLengths()
    {
        return [
            self::FIELD_ID_SCOPE => 255,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getRelationships()
    {
        return [];
    }
}
