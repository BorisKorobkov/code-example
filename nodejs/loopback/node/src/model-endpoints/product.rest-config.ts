import {ModelCrudRestApiConfig} from '@loopback/rest-crud';
import {Product} from '../models';

const config: ModelCrudRestApiConfig = {
  model: Product,
  pattern: 'CrudRest',
  dataSource: 'postgres',
  basePath: '/products',
  readonly: false,
};
module.exports = config;
