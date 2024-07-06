import { extend } from 'flarum/common/extend';
import type ItemList from 'flarum/common/utils/ItemList';
import DiscussionListItem from 'flarum/forum/components/DiscussionListItem';

import tagLabel from 'flarum/tags/helpers/tagLabel';

import type Mithril from 'mithril';
import type Discussion from 'flarum/common/models/Discussion';

/**
 * Only shows secondary tag labels on the DiscussionList.
 */
export default function onlySecondaryTagsOnDiscussionList() {
  extend(DiscussionListItem.prototype, 'infoItems', function (this: DiscussionListItem, items: ItemList<Mithril.Children>) {
    if (items.has('tags')) items.remove('tags');

    const discussion = this.attrs.discussion as Discussion;

    // enforce requested ordering of secondary then primary tags
    const getSortVal = (tag) => {
      if (tag.position() === null) return -10e6;

      return tag.position();
    };

    let tags = discussion?.tags();

    if (tags?.length) {
      tags = tags.sort((a, b) => getSortVal(a) - getSortVal(b));

      items.add(
        'tags',
        tags.map((t) => tagLabel(t)),
        -100
      );
    }
  });
}
