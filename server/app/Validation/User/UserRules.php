<?php namespace App\Validation\User;

use App\Data\Models\User as Model;
use App\Json\Schemas\UserSchema as Schema;
use App\Validation\BaseRules;
use App\Validation\ErrorCodes;
use Limoncello\Validation\Contracts\Rules\RuleInterface;

/**
 * @package App
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
final class UserRules extends BaseRules
{
    /**
     * @return RuleInterface
     */
    public static function userType(): RuleInterface
    {
        return self::equals(Schema::TYPE);
    }

    /**
     * @return RuleInterface
     */
    public static function firstName(): RuleInterface
    {
        $maxLength = Model::getAttributeLengths()[Model::FIELD_FIRST_NAME];

        return self::asSanitizedString(self::stringLengthBetween(1, $maxLength));
    }

    /**
     * @return RuleInterface
     */
    public static function lastName(): RuleInterface
    {
        $maxLength = Model::getAttributeLengths()[Model::FIELD_LAST_NAME];

        return self::asSanitizedString(self::stringLengthBetween(1, $maxLength));
    }

    /**
     * @return RuleInterface
     */
    public static function email(): RuleInterface
    {
        $maxLength = Model::getAttributeLengths()[Model::FIELD_EMAIL];

        return self::isString(
            self::stringLengthBetween(
                1,
                $maxLength,
                self::filter(FILTER_VALIDATE_EMAIL, null, ErrorCodes::IS_EMAIL)
            )
        );
    }

    /**
     * @return RuleInterface
     */
    public static function password(): RuleInterface
    {
        return self::isString(self::stringLengthMin(Model::MIN_PASSWORD_LENGTH));
    }
}