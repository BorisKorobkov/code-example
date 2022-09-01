import {MixinTarget} from '@loopback/core';
import {property, Model} from '@loopback/repository';

/**
 * A mixin factory to add `last_edited_on` and `last_edited_by` properties
 *
 * @param superClass - Base Class
 * @typeParam T - Model class
 * @link https://loopback.io/doc/en/lb4/migration-models-mixins.html#loopback-4-approach
 */
export function LastEditedMixin<T extends MixinTarget<Model>>(
    superClass: T,
) {
  class MixedModel extends superClass {
    @property({
      type: 'date',
      default: () => new Date(),
    })
    last_edited_on?: string;

    @property({
      type: 'number',
      // default: () => , // @todo set the current user
    })
    last_edited_by?: number;
  }
  return MixedModel;
}
