<?php

declare(strict_types=1);

namespace PhpStanCustom\Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\If_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * only allow boolean in the if statement - fix
 */
class BooleanInIfConditionRule implements Rule
{


    public function getNodeType(): string
    {
        return If_::class;
    }


    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof If_) {
            return [];
        }

        $conditionType = $scope->getType($node->cond);
        if (!$conditionType instanceof \PHPStan\Type\BooleanType) {
            return [
                RuleErrorBuilder::message('Only boolean expressions are allowed in if statements.')->build(),
            ];
        }

        return [];
    }
}
