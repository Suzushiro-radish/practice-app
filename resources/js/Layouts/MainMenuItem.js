import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import classNames from 'classnames';

export default ({ link, text }) => {
  const isActive = route().current(link + '*');

  const textClasses = classNames({
    'text-black': isActive,
    'text-indigo-200 text-black': !isActive
  });

  return (
    <div className="mb-4">
      <InertiaLink href={route(link)} className="items-center py-3">
        <div className={textClasses}>{text}</div>
      </InertiaLink>
    </div>
  );
};