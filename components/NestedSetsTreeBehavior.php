<?php

    namespace app\components;

    use RecursiveArrayIterator;
    use RecursiveIteratorIterator;
    use yii\base\Behavior;

    class NestedSetsTreeBehavior extends Behavior
    {

        /**
         * @var string
         */
        public $leftAttribute = 'lft';

        /**
         * @var string
         */
        public $rightAttribute = 'rgt';

        /**
         * @var string
         */
        public $depthAttribute = 'depth';

        /**
         * @var string
         */
        public $labelAttribute = 'name';

        /**
         * @var string
         */
        public $childrenOutAttribute = 'children';

        /**
         * @var string
         */
        public $labelOutAttribute = 'title';

        /**
         * @var string
         */
        public $hasChildrenOutAttribute = 'folder';

        /**
         * @var string
         */
        public $hrefOutAttribute = 'href';

        /**
         * @var null|callable
         */
        public $makeLinkCallable = null;

        /**
         * @var string
         */
        public $onlyActive = true;

        const LEAVES = 'leaves';
        const CHILDREN = 'children';

        public function tree($request = false)
        {
            $makeNode = function ($node)
            {
                if($node['child_allowed'] == 1)
                    $node[$this->childrenOutAttribute] = [];

                $newData = [
                    $this->labelOutAttribute => $node[$this->labelAttribute],
                ];
                if(is_callable($makeLink = $this->makeLinkCallable)) {
                    $newData += [
                        $this->hrefOutAttribute => $makeLink($node),
                    ];
                }
                return array_merge($node, $newData);
            };

            if($request == self::LEAVES) {
                $query = $this->owner->leaves();
            } else if($request == self::CHILDREN) {

                $query = $this->owner->children();
            } else {
                $query = $this->owner->find()->asArray();
            }

            if($this->onlyActive)
                $query->andWhere(['active' => 1]);

            $collection = $query->asArray()->all();

            if(count($collection) > 0) {
                foreach ($collection as &$col)
                    $col = $makeNode($col);

                $min_lvl_arr = \yii\helpers\ArrayHelper::getColumn($collection, 'lvl');
                $min_lvl = min($min_lvl_arr);

                foreach ($collection as $node) {

                    if($node['lvl'] == $min_lvl)
                        $tree[] = $node;
                    else
                        $this->recursiveSearch($tree, $node);
                }
            }

            return $tree;
        }

        function recursiveSearch(&$arr, $node)
        {

            foreach ($arr as $key => &$value) {

                if($value['lft'] < $node['lft'] and $value['rgt'] > $node['rgt'] and $value['root'] == $node['root']) {

                    if($node['lvl'] == $value['lvl'] + 1) {
                        $value[$this->hasChildrenOutAttribute] = 1;
                        $value[$this->childrenOutAttribute][] = $node;
                    } else {
                        return $this->recursiveSearch($value[$this->childrenOutAttribute], $node);
                    }
                }
            }
        }

    }
    