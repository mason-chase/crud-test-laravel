<?php

namespace App\Repositories;

use App\Exceptions\ModelNotSetInRepositoryException;

class BaseRepository
{
	protected $model = null;

	/**
	 * return new model or exception
	 *
	 * @return mixed
	 * @throws ModelNotSetInRepositoryException
	 */
	public  function getModel()
	{
		if (is_null($this->model))
		{
			throw new ModelNotSetInRepositoryException();
		}
		if (is_string($this->model))
		{
			$this->model = (new $this->model);
		}
		return $this->model;
	}
}