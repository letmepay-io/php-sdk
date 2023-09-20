<?php

namespace LetmepayIo\Sdk\HttpResources\Responses;

class ErrorLMPResponse implements LMPResponseInterface
{
    private array $errors = [];
    private string $message = '';
    private string $debugTraceId = '';

    private string $status = '';
    public function isOk(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getDebugTraceId(): string
    {
        return $this->debugTraceId;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    public function setData(array $data): LMPResponseInterface
    {
        $this->debugTraceId = $data['debug_trace_id'];
        $this->message = $data['message'];
        $this->errors = $data['errors'];
        $this->status = $data['status'];

        return $this;
    }
}
