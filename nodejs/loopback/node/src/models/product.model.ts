import {Entity, model, property} from '@loopback/repository';

@model()
export class Product extends Entity {
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

  @property({
    type: 'date',
  })
  last_edited_on?: string;

  @property({
    type: 'number',
  })
  last_edited_by?: number;

  @property({
    type: 'boolean',
  })
  is_deleted?: boolean;

  constructor(data?: Partial<Product>) {
    super(data);
  }
}

export interface ProductRelations {
  // describe navigational properties here
}

export type ProductWithRelations = Product & ProductRelations;
