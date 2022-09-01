import {MixinTarget} from '@loopback/core';
import {property, Model} from '@loopback/repository';

/**
 * A mixin factory to add `is_deleted` property
 *
 * @param superClass - Base Class
 * @typeParam T - Model class
 * @link https://loopback.io/doc/en/lb4/migration-models-mixins.html#loopback-4-approach
 */
export function IsDeletedMixin<T extends MixinTarget<Model>>(
    superClass: T,
) {
  class MixedModel extends superClass {
    @property({
      type: 'boolean',
      default: false,
    })
    is_deleted?: boolean;
  }
  return MixedModel;
}
