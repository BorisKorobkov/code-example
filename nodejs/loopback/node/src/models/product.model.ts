import {model, property} from '@loopback/repository';
import {BaseEntity} from './base-entity';
import {LastEditedMixin} from "../mixins/last-edited.mixin";
import {IsDeletedMixin} from "../mixins/is_deleted.mixin";

@model()
export class Product extends LastEditedMixin(IsDeletedMixin(BaseEntity)) {
  @property({
    type: 'number',
    id: true,
    generated: true,
  })
  id?: number;

  @property({
    type: 'date',
  })
  release_date?: string;

  @property({
    type: 'date',
  })
  production_start_date?: string;

  @property({
    type: 'date',
  })
  production_end_date?: string;

  @property({
    type: 'string',
  })
  deviations?: string;

  @property({
    type: 'string',
  })
  raw_materials?: string;

  @property({
    type: 'date',
  })
  created_on?: string;

  @property({
    type: 'number',
  })
  created_by?: number;

  constructor(data?: Partial<Product>) {
    super(data);
  }
}

export interface ProductRelations {
  // describe navigational properties here
}

export type ProductWithRelations = Product & ProductRelations;
