import React from 'react';
import cx from 'classnames';

export default ({ loading, className, children, ...props }) => {
  const classNames = cx(
    'flex items-center',
    'focus:outline-none',
    {
      'pointer-events-none bg-opacity-75 select-none': loading
    },
    className
  );
  return (
    <button className={classNames} {...props}>
      <div className="mr-2 btn-spinner" />
      {children}
    </button>
  );
};