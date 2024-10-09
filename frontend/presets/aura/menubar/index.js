export default {
    root: {
        class: [
            'sticky top-0 z-50',
            'w-full',
            // Flexbox
            'flex',
            'items-center',
            'justify-between',

            // Spacing
            'p-2',

            // Shape
            'rounded-md',

            // Color
            'bg-surface-0 dark:bg-surface-900',
            'border border-surface-200 dark:border-surface-700'
        ]
    },
    rootList: ({ props }) => ({
        class: [
            // Flexbox
            'md:flex',
            'items-center',
            'flex-wrap',
            'flex-col md:flex-row',
            { hidden: !props?.mobileActive, flex: props?.mobileActive },

            // Position
            'absolute md:relative',
            'top-full left-0',
            'md:top-auto md:left-auto',

            // Size
            'w-full md:w-auto',

            // Spacing
            'm-0',
            'p-1 md:py-0 md:p-0',
            'list-none',

            // Shape
            'shadow-md md:shadow-none',
            'border-0',

            // Color
            'bg-surface-0 dark:bg-surface-900 md:bg-transparent',

            // Misc
            'outline-none'
        ]
    }),
    item: {
        class: 'md:relative md:w-auto w-full static my-[2px] [&:first-child]:mt-0'
    },
    itemContent: ({ context }) => ({
        class: [
            // Shape
            'rounded-[4px]',

            // Colors
            'text-surface-700 dark:text-white/80',
            {
                'text-surface-500 dark:text-white/70': !context.focused && !context.active,
                'text-surface-500 dark:text-white/70 bg-surface-200': context.focused && !context.active,
                'bg-highlight': (context.focused && context.active) || context.active || (!context.focused && context.active)
            },

            // States
            {
                'hover:bg-surface-100 dark:hover:bg-[rgba(255,255,255,0.03)]': !context.active,
                'hover:bg-highlight-emphasis': context.active
            },

            // Transitions
            'transition-all',
            'duration-200'
        ]
    }),
    itemLink: ({ context }) => ({
        class: [
            'relative',

            // Flexbox
            'flex',
            'items-center',

            // Spacing
            'py-2',
            'px-3',

            // Size
            {
                'pl-9 md:pl-5': context.level === 1,
                'pl-14 md:pl-5': context.level === 2
            },
            'leading-none',

            // Misc
            'select-none',
            'cursor-pointer',
            'no-underline ',
            'overflow-hidden'
        ]
    }),
    itemIcon: {
        class: 'mr-2'
    },
    submenuIcon: ({ props }) => ({
        class: [
            {
                'ml-auto md:ml-2': props.root,
                'ml-auto': !props.root
            }
        ]
    }),
    submenu: ({ props }) => ({
        class: [
            'flex flex-col',
            // Size
            'rounded-md',
            'min-w-[12.5rem]',

            // Spacing
            'p-1',
            'm-0',
            'list-none',

            // Shape
            'shadow-none md:shadow-md',
            'border border-surface-200 dark:border-surface-700',

            // Position
            'static md:absolute',
            'z-10',
            { 'md:absolute md:left-full md:top-0': props.level > 1 },

            // Color
            'bg-surface-0 dark:bg-surface-900'
        ]
    }),
    separator: {
        class: 'border-t border-surface-200 dark:border-surface-600 my-[2px]'
    },
    button: {
        class: [
            // Flexbox
            'flex md:hidden',
            'items-center justify-center',

            // Size
            'w-7',
            'h-7',

            // Shape
            'rounded-full',
            // Color
            'text-surface-500 dark:text-white/80',

            // States
            'hover:text-surface-600 dark:hover:text-white/60',
            'hover:bg-surface-100 dark:hover:bg-[rgba(255,255,255,0.03)]',
            'focus:outline-none focus:outline-offset-0',
            'focus:ring-1 focus:ring-primary-500 dark:focus:ring-primary-400',

            // Transitions
            'transition duration-200 ease-in-out',

            // Misc
            'cursor-pointer',
            'no-underline'
        ]
    },
    start: {
        class: 'order-1 md:order-first'
    },
    end: {
        class: 'order-last self-center'
    }
};
