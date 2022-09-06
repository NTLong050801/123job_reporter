<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/8/18
 * Time: 10:45 AM
 */

namespace Workable\Support\Traits;

trait FullTextSearch
{
    /**
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL


        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */

            if (strlen($word) >= 2) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term,$option = array())
    {

        $columns = implode(',', $this->searchable);

        $word_distance = array_get($option,'word_distance','');

        $parameters = $this->fullTextWildcards($term);
        if ($word_distance) $parameters = '"'.$this->fullTextWildcards($term).'" '.$word_distance;

        $sort          = $word_distance = array_get($option,'sort','');
        $select_column = $this->getColumnSelect($option);

        if ($sort)
        {
            $query->selectRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE) AS score",[$parameters]);
            if ($select_column) $query->selectRaw(\DB::raw($select_column));
        }
        

        $query->whereRaw("MATCH ({$columns}) AGAINST ( ?  IN BOOLEAN MODE )", $parameters);

        if ($sort) $query->orderByDesc('score');

        return $query;
    }


    public function getColumnSelect($option)
    {
        $select_column = array_get($option,'select','');
        $select_column = (is_array($select_column)) ?  implode(',',$select_column) : $select_column;

        return $select_column;
    }

}