import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import classNames from 'classnames';

export default ({ link, text }) => {
  const isActive = route().current(link + '*');

  const textClasses = classNames({
    'text-black': isActive,
    'text-indigo-200ｓ text-black': !isActive
  });

  return (
    <div className="flex-initial w-48 bg-amber-400 hover:bg-amber-600 border-4 border-inherit text-center">
      <InertiaLink href={route(link)}>
        <div className={textClasses}>{text}</div>
      </InertiaLink>
    </div>
  );
};