import {inject} from '@loopback/core';
import {DefaultCrudRepository} from '@loopback/repository';
import {PostgresDataSource} from '../datasources';
import {Product, ProductRelations} from '../models';

export class ProductRepository extends DefaultCrudRepository<
  Product,
  typeof Product.prototype.id,
  ProductRelations
> {
  constructor(
    @inject('datasources.postgres') dataSource: PostgresDataSource,
  ) {
    super(Product, dataSource);
  }

  /**
   * @link https://loopback.io/doc/en/lb4/migration-models-operation-hooks.html
   */
  definePersistedModel(entityClass: typeof Product) {
    const modelClass = super.definePersistedModel(entityClass);

    // webhook for setting "last_edited_on"
    // ../../node_modules/loopback-datasource-juggler/lib/dao.js
    modelClass.observe('persist', async ctx => {
      ctx.data.last_edited_on = new Date();
      // ctx.data.last_edited_by = ; // @todo set the current user
    });

    return modelClass;
  }

  // set "is_deleted=true" instead of deleting
  async deleteById(id: any, options: any) {
    this.updateById(id, {is_deleted: true});
  }

}
