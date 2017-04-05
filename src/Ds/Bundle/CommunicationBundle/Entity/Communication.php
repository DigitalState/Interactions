<?php

namespace Ds\Bundle\CommunicationBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Communication
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_communication.communication.filter"},
 *          "normalization_context"={"groups"={"communication_output"}},
 *          "denormalization_context"={"groups"={"communication_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CommunicationBundle\Repository\CommunicationRepository")
 * @ORM\Table(name="ds_communication")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Communication implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"communication_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"communication_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"communication_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"communication_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;
}
