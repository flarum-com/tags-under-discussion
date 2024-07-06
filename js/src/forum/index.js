import app from 'flarum/forum/app';

import tagsUnderDiscussions from './tagsUnderDiscussions';

app.initializers.add('flarum-com/tags-under-discussion', () => {
  tagsUnderDiscussions();
});
