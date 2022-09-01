import {MixinTarget} from '@loopback/core';
import {property, Model} from '@loopback/repository';

/**
 * A mixin factory to add `created_on` and `created_by` properties
 *
 * @param superClass - Base Class
 * @typeParam T - Model class
 * @link https://loopback.io/doc/en/lb4/migration-models-mixins.html#loopback-4-approach
 */
export function CreatedMixin<T extends MixinTarget<Model>>(
    superClass: T,
) {
  class MixedModel extends superClass {
    @property({
      type: 'date',
      default: () => new Date(),
    })
    created_on?: string;

    @property({
      type: 'number',
      // default: () => , // @todo set the current user
    })
    created_by?: number;
  }

  return MixedModel;
}
