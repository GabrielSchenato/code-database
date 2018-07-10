<?php

namespace CodePress\CodeDatabase\Contracts;

/**
 *
 * @author gabriel
 */
interface CriteriaCollectionInterface
{

    public function addCriteria(CriteriaInterface $criteria);

    public function getCriteriaCollection();

    public function getByCriteria(CriteriaInterface $criteriaInterface);

    public function applyCriteria();
    
    public function ignoreCriteria(bool $isIgnore = true);
}
