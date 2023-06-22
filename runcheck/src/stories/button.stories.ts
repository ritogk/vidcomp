import Button from "@/components/button.vue"
import type { Meta, StoryObj } from "@storybook/vue3"

type Story = StoryObj<typeof Button>

const meta: Meta<typeof Button> = {
  title: "components/button",
  component: Button,
  tags: ["autodocs"]
}

export const Default: Story = {
  render: (args) => ({
    components: { Button: Button },
    setup() {
      return { args }
    },
    template: `<Button v-bind='args' class="mt-7"></Button>`
  }),
  args: {
    label: "新規登録",
    type: "button",
    variant: "primary"
  },
  argTypes: {
    variant: {
      control: {
        type: "inline-radio"
      },
      options: ["primary", "danger", undefined]
    },
    type: {
      control: {
        type: "inline-radio"
      },
      options: ["button", "submit", "reset"]
    }
  }
}

export const Danger: Story = {
  render: (args) => ({
    components: { Button: Button },
    setup() {
      return { args }
    },
    template: `<Button v-bind='args' class="mt-7"></Button>`
  }),
  args: {
    label: "削除します",
    type: "button",
    variant: "danger"
  }
}

export const Secondary: Story = {
  render: (args) => ({
    components: { Button: Button },
    setup() {
      return { args }
    },
    template: `<Button v-bind='args' class="mt-7"></Button>`
  }),
  args: {
    label: "編集する",
    type: "button"
  }
}

export default meta
