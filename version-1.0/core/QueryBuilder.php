<?php
class QueryBuilder
{
    private $table;
    private $entityClass;
    private $wheres = [];
    private $orderBy = [];
    private $limit = null;
    private $offset = null;
    private $joins = [];
    private $selects = ['*'];
    
    public function __construct($table)
    {
        $this->table = $table;
        $this->db = Database::getInstance();
    }
    
    public function setEntity($entityClass)
    {
        $this->entityClass = $entityClass;
        return $this;
    }
    
    public function select($columns)
    {
        if (is_array($columns)) {
            $this->selects = $columns;
        } else {
            $this->selects = func_get_args();
        }
        return $this;
    }
    
    public function where($column, $operator, $value = null)
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }
        
        $this->wheres[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'type' => 'AND'
        ];
        
        return $this;
    }
    
    public function orWhere($column, $operator, $value = null)
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }
        
        $this->wheres[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'type' => 'OR'
        ];
        
        return $this;
    }
    
    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy[] = "{$column} {$direction}";
        return $this;
    }
    
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    
    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
    
    public function join($table, $first, $operator, $second, $type = 'INNER')
    {
        $this->joins[] = [
            'table' => $table,
            'first' => $first,
            'operator' => $operator,
            'second' => $second,
            'type' => $type
        ];
        
        return $this;
    }
    
    public function get()
    {
        $sql = $this->buildSelect();
        $params = $this->getWhereParams();
        
        $stmt = $this->db->query($sql, $params);
        $results = $stmt->fetchAll();
        
        if ($this->entityClass) {
            return array_map(function($item) {
                return new $this->entityClass($item);
            }, $results);
        }
        
        return $results;
    }
    
    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return !empty($results) ? $results[0] : null;
    }
    
    public function count()
    {
        $this->selects = ['COUNT(*) as count'];
        $result = $this->first();
        return $result ? $result->count : 0;
    }
    
    private function buildSelect()
    {
        $select = implode(', ', $this->selects);
        $sql = "SELECT {$select} FROM {$this->table}";
        
        // Build joins
        foreach ($this->joins as $join) {
            $sql .= " {$join['type']} JOIN {$join['table']} ON {$join['first']} {$join['operator']} {$join['second']}";
        }
        
        // Build where clauses
        if (!empty($this->wheres)) {
            $sql .= " WHERE " . $this->buildWheres();
        }
        
        // Build order by
        if (!empty($this->orderBy)) {
            $sql .= " ORDER BY " . implode(', ', $this->orderBy);
        }
        
        // Build limit and offset
        if ($this->limit !== null) {
            $sql .= " LIMIT " . $this->limit;
        }
        
        if ($this->offset !== null) {
            $sql .= " OFFSET " . $this->offset;
        }
        
        return $sql;
    }
    
    private function buildWheres()
    {
        $clauses = [];
        
        foreach ($this->wheres as $index => $where) {
            $clause = $index === 0 ? '' : " {$where['type']} ";
            $clause .= "{$where['column']} {$where['operator']} :where_{$index}";
            $clauses[] = $clause;
        }
        
        return implode('', $clauses);
    }
    
    private function getWhereParams()
    {
        $params = [];
        
        foreach ($this->wheres as $index => $where) {
            $params["where_{$index}"] = $where['value'];
        }
        
        return $params;
    }
}